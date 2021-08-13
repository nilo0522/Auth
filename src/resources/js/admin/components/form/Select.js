import React from "react";

function Select({ form, keyIndex, data = {} }) {
  return (
    <div className={`relative`}>
      <select
        name={keyIndex}
        className={`border bg-white border-gray-400 focus:border-primary appearance-none rounded-lg px-3 py-2 appearance-none outline-none w-full`}
        onChange={form.onChange}
        defaultValue={form.value || data[keyIndex] || ``}
      >
        <option value=""></option>
        {form.options.map(option => (
          <option key={option.value} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
      <div
        className={`pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700`}
      >
        <svg
          className={`fill-current h-4 w-4`}
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
        >
          <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
        </svg>
      </div>
    </div>
  );
}

export default Select;
