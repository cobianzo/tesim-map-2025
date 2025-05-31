import React, { useState } from "react";

import "./TogglePill.scss";
import { sanitizePeriodName } from "./helpers/utils";

export default function TogglePill({ optionA, optionB, optionALabel, optionBLabel, selected, onToggle }) {

  const toggle = () => {
    let sel = '';
    if (selected === optionA) {
      sel = optionB;
    } else {
      sel = optionA;
    }
    onToggle?.(sel);
  };


  const computedOptionALabel = sanitizePeriodName(optionALabel);
  const computedOptionBLabel = sanitizePeriodName(optionBLabel);

  return (
    <button
      onClick={toggle}
      className="toggle-pill"
      aria-pressed={selected !== ''}
    >
      <span
        className={`toggle-pill__option ${
          selected === optionA ? "active" : "inactive"
        }`}
      >
        {computedOptionALabel}
      </span>
      <span
        className={`toggle-pill__option ${
          selected === optionB ? "active" : "inactive"
        }`}
      >
        {computedOptionBLabel}
      </span>
    </button>
  );
}
