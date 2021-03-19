<template>
  <div :class="wrapperClass">
    <the-mask
      :mask="mask"
      :value="innerValue"
      v-on:input="onInput"
      :tokens="plusTokens"
      :placeholder="placeholder"
      :disabled="disabled"
      masked
      type="tel"
      :class="inputClass"
      ref="phoneMask"
    />
    <CountryFlag :country="country" v-if="country && showFlag" :size="flagSize" :class="flagClass"/>
  </div>
</template>

<script>
import { TheMask } from "vue-the-mask";
import { parsePhoneNumberFromString } from "libphonenumber-js";
import CountryFlag from "vue-country-flag";

import {
  getMaskToLibPhoneNumber,
  findFirstCountryByAlpha2,
  findFirstCountryByCode,
  isCanada
} from "./country_telephone_data.js";
import visitorInfo from "visitor-info";

export default {
  name: "PhoneMaskInput",
  props: {
    value: {
      type: [String, Number]
    },
    showFlag: {
      type: Boolean,
      default: false
    },
    autoDetectCountry: {
      type: Boolean,
      default: false
    },
    defaultCountry: {
      type: String
    },
    placeholder: {
      type: String
    },
    flagSize: {
      type: String,
      default: "normal"
    },
    disabled: {
      type: Boolean,
      default: false
    },
    wrapperClass: {
      type: String,
      default: "phone-mask-wrapper-lib"
    },
    inputClass: {
      type: String,
      default: "phone-input-lib"
    },
    flagClass: {
      type: String,
      default: "country-flag-lib"
    }
  },
  components: { TheMask, CountryFlag },
  data() {
    return {
      innerValue: this.value,
      countryCode: "",
      mask: "*############",
      defaultMask: "*############",
      country: "",
      isValid: false,
      plusTokens: {
        "#": {
          pattern: /\d/
        },
        "*": {
          pattern: /\d|\+/
        }
      }
    };
  },
  computed: {
    currentNumber: function() {
      const plus = /^\+/.test(this.innerValue) || !this.innerValue ? "" : "+";
      const filteredNumberArr = this.innerValue
        ? this.innerValue.match(/[\d+]/g)
        : null;
      const filteredNumber = filteredNumberArr
        ? filteredNumberArr.join("")
        : "";

      return this.mask === this.defaultMask
        ? `${plus}${filteredNumber}`
        : filteredNumber;
    }
  },
  methods: {
    onInput: function(value) {
      let filteredValue = value.match(/[\d+]/g);
      this.innerValue = filteredValue ? filteredValue.join("") : "";
      this.updateMaskData();

      this.$nextTick(function() {
        setTimeout(this.setFocusToEnd.bind(this), 0);
      });
    },

    setFocusToEnd: function() {
      const length = this.$refs.phoneMask.$el.value.length;
      this.$refs.phoneMask.$el.focus();
      this.$refs.phoneMask.$el.setSelectionRange(length, length);
    },

    updateMaskData: function() {
      let {
        currentNumber,
        visitorCountry,
        innerValue,
        countryCode,
        defaultMask,
        autoDetectCountry,
        defaultCountry
      } = this;

      let phoneInfo = parsePhoneNumberFromString(currentNumber);

      if (!phoneInfo && !currentNumber) {
        let country = findFirstCountryByAlpha2(defaultCountry);
        if (country) {
          phoneInfo = { country: defaultCountry };
          autoDetectCountry = false;
          this.innerValue = `+${country.code}`;
        }
      }

      if (phoneInfo && !phoneInfo.country) {
        switch (phoneInfo.countryCallingCode) {
          case "44": {
            phoneInfo.country = "GB";
            break;
          }
          case "1": {
            if (currentNumber.length > 4)
              phoneInfo.country = isCanada(currentNumber) ? "CA" : "US";
            break;
          }
        }
      } else if (autoDetectCountry && visitorCountry && !innerValue)
        phoneInfo = { country: visitorCountry };
      else if (!phoneInfo && currentNumber.length > 2)
        phoneInfo = { country: findFirstCountryByCode(currentNumber) };

      const computedMask = getMaskToLibPhoneNumber(phoneInfo);
      const computedCountry =
        phoneInfo && phoneInfo.country ? phoneInfo.country.toLowerCase() : "";

      if (autoDetectCountry && visitorCountry) {
        if (!innerValue) this.innerValue = computedMask.countryCode;
        this.visitorCountry = null;
      }

      if (computedMask && computedMask.mask) {
        this.mask = computedMask.mask;
        this.country = computedCountry;
        this.countryCode = computedMask.countryCode;
        this.isValid = !!phoneInfo && !!phoneInfo.isValid && phoneInfo.isValid();
      } else if (countryCode.length > currentNumber.length) {
        this.mask = defaultMask;
        this.country = "";
        this.countryCode = "";
        this.isValid = false;
      }
    }
  },
  watch: {
    currentNumber(value) {
      this.$emit("input", value);
      this.$emit("onValidate", {number: value, isValidByLibPhoneNumberJs: this.isValid, country: this.country});
    }
  },
  beforeMount() {
    if (this.autoDetectCountry) {
      const visitorContryInfo = visitorInfo();
      this.visitorCountry =
        visitorContryInfo && visitorContryInfo.country
          ? visitorContryInfo.country.alpha2
          : "";
    }
    this.updateMaskData();
  },
  mounted() {
     this.$refs.phoneMask.$el.onblur = () => {this.$emit("onBlur")}
     this.$refs.phoneMask.$el.onfocus = () => {this.$emit("onFocus")}

  }
};
</script>

<style scoped>
.phone-mask-wrapper-lib {
  display: flex;
  flex-direction: row;
  align-items: center;
  height: 40px;
}

.phone-input-lib {
  height: 20px;
}

.country-flag-lib {
  margin: 0;
}
</style>
