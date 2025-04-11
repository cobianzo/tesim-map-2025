import React, { useState } from "react";

import "./TogglePill.scss";

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
        {optionALabel}
      </span>
      <span
        className={`toggle-pill__option ${
          selected === optionB ? "active" : "inactive"
        }`}
      >
        {optionBLabel}
      </span>
    </button>
  );
}
