{

  const init = () => {
    const $form = document.querySelector(`.newsletter-form`);
    $form.noValidate = true;
    $form.addEventListener(`submit`, handeSubmitForm);

    addValidationListeners(Array.from($form.elements));
  };

  const handeSubmitForm = e => {
    const $form  = e.target;

    if(!$form.checkValidity()){
      e.preventDefault();
      Array.from($form.elements).forEach(validateField);
    }
  };

  const validateField = $field => {
    let message;
    if($field.validity.valueMissing){
      message = `Oeps! Je vulde geen adres in`;
    }
    if($field.validity.typeMismatch){
      message = `Hmm, daar klopt iets niet`;
    }
    if(message){
      const $info = getInfoElement($field); // error-message selecteren
      $info.classList.remove(`success`);
      $info.classList.add(`error`);
      $info.textContent = message;
    }
  };

  const getInfoElement = $element => {
    const $testElement = $element.parentElement.querySelector(`.info`);
    if(!$testElement){
      return getInfoElement($element.parentElement);
    }
    return $testElement;
  };

  const addValidationListeners = elements => {
    elements.forEach($element => {
      $element.addEventListener(`blur`, handleBlurField);
      $element.addEventListener(`input`, handleInputField);
    });
  };

  const handleBlurField = e => {
    validateField(e.currentTarget);
  };

  const handleInputField = e => {
    const $field = e.currentTarget;
    if($field.validity.valid){
      const $info = getInfoElement($field);
      $info.classList.remove(`error`);
      $info.classList.add(`success`);
      $info.textContent = $info.dataset.success;
    }
  };

  init();
}
