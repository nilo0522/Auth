import React, { useRef, useState, useEffect } from "react";
import { Button, Form, } from "~/components";
import { NavLink, useParams } from "react-router-dom";
import { formSubmit } from "~/helpers/utilities";


const Edit = () => {
  const [data, setData] = useState({});
  const [errors, setErrors] = useState({});
  const [isFetching, setIsFetching] = useState(false);
  const [loading, setLoading] = useState(false);
  const [formFields,setFormFields] = useState(false)
  const form = useRef(null);

  let { id } = useParams();

  useEffect(() => {
    const fetchData = async () => {
      const { data } = await axios.get(`/api/stripe/${id}`);
     
      setData(data.stripe);
      setFormFields(data.form);

      setIsFetching(true);
      
    };
    fetchData();
  }, []);

  const handleSubmit = async evt => {
    evt.preventDefault();
    let formData = new FormData(form.current);
    window.loadingStatus = `Saving data...`;
    setLoading(true);

    let errors = await formSubmit(
      `patch`,
      `/api/stripe/${id}`,
      formData,
      `Stripe successfully updated`,
      `/admin/stripe`
    );
    setLoading(false);
    setErrors(errors || {});
  };
  
  if (!isFetching) return null;
  
  return (
    <div>
      <span
        className={`block border-b font-black mb-4 pb-2 text-blue-900 text-lg w-full`}
      >
        Edit Stripe
      </span>
      <form ref={form} data={data} onSubmit={handleSubmit}>
        <Form errors={errors} formFields={formFields} data={data} >
        

        </Form>
     
   

        <div className={`items-center lg:flex mb-4 lg:mb-5 mt-12`}>
          <span className={`lg:w-48`}></span>
          <Button
            disabled={loading}
            className={`bg-blue-500 hover:bg-blue-700 text-white mr-4`}
          >
            {loading && <i className="fa fa-circle-notch fa-spin mr-2" />}{" "}
            Submit
          </Button>
          <NavLink to="/stripe">
            <Button className={`bg-white border hover:bg-gray-100`}>
              Cancel
            </Button>
          </NavLink>
        </div>
      </form>
    </div>
  );
};

export default Edit;
