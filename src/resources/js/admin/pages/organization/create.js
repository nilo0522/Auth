import React, { useRef, useState,useEffect } from "react";
import { Button, Form } from "~/components";
import { NavLink } from "react-router-dom";
import { formSubmit } from "~/helpers/utilities";
import { formFields } from "./form";

const Create = () => {
  const [errors, setErrors] = useState({});
  const form = useRef(null);
  const [loading, setLoading] = useState(false);

  const handleSubmit = async evt => {
    evt.preventDefault();
    let formData = new FormData(form.current);
    window.loadingStatus = `Saving data...`;
    setLoading(true);

    let errors = await formSubmit(
      `post`,
      `/api/organization`,
      formData,
      `Organization successfully added`,
      `/admin/organization`
    );
    setLoading(false);
    setErrors(errors || {});
  };
useEffect(() => {
   console.log(form)
}, [form])
  return (
    <div>
      <span
        className={`block border-b font-black mb-4 pb-2 text-blue-900 text-lg w-full`}
      >
        Create Organization
      </span>
      <form ref={form} onSubmit={handleSubmit}>
        <Form errors={errors} formFields={formFields} />
        <div className={`items-center lg:flex mb-4 lg:mb-5 mt-12`}>
          <span className={`lg:w-48`}></span>
          <Button
            disabled={loading}
            className={`bg-blue-500 hover:bg-blue-700 text-white mr-4`}
          >
            {loading && <i className="fa fa-circle-notch fa-spin mr-2" />}{" "}
            Submit
          </Button>
          <NavLink to="/roles">
            <Button className={`bg-white border hover:bg-gray-100`}>
              Cancel
            </Button>
          </NavLink>
        </div>
      </form>
    </div>
  );
};

export default Create;
