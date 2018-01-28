{
  const $dayInput = document.querySelector(`[name="day"]`);
  const $tagInput = document.querySelector(`[name="tag"]`);
  const $locationInput = document.querySelector(`[name="locatie"]`);
  const $results = document.getElementById(`results`);
  const $noJSElements = document.querySelectorAll(`.noJS`);

  const init = () => {
    $noJSElements.forEach($element => {
      $element.classList.add(`hidden`);
    });

    const $form = document.querySelector(`.newsletter-form`);
    const $filterForm = document.querySelector(`.programma-filters`);
    const $inputs = [$dayInput, $tagInput, $locationInput];

    $form.noValidate = true;
    $form.addEventListener(`submit`, handeSubmitForm);
    addValidationListeners(Array.from($form.elements));

    if($filterForm){
      if($inputs){
        addHandlerListeners($inputs);
      }
      loadAllEvents();
    }
  };

  const addHandlerListeners = elements => {
    elements.forEach($element => {
      $element.addEventListener(`input`, handleInputFilter);
    });
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
      const $info = getInfoElement($field);
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

  const handleInputFilter = () => {
    const day = $dayInput.value.trim();
    const tag = $tagInput.value.trim();
    const location = $locationInput.value.trim();

    if (day !== `` || tag !== `` || location !== ``) {
      loadFilteredEvents(day, tag, location);
    }else if((day === ``) && (tag === ``) && (location === ``)){
      loadAllEvents();
    }
  };

  const loadAllEvents = () => {
    fetch(`index.php?page=programma`, {
      headers: new Headers({
        Accept: `application/json`,
      }),
    })
      .then(r => r.json())
      .then(data => createEventItem(data));
  };

  const loadFilteredEvents = (day, tag, location) => {
    fetch(`index.php?page=programma&day=${day}&tag=${tag}&locatie=${location}`, {
      headers: new Headers({
        Accept: `application/json`,
      }),
    })
      .then(r => r.json())
      .then(data => createEventItem(data));
  };

  const createEventItem = results => {
    if (results.length === 0) {
      $results.innerHTML = `<p>Uw zoekopdracht leverde geen resultaten op.</p>`;
    } else {
      const items = results
        .map(result =>
          `<a class="section-item" href="index.php?page=details&id=${result.id}">
            <li class="list-item" style="background-image: url(./assets/images/${result.code}/1.jpg)">
              <div class="item bgBlueDark">
                <h3 class="subtitle white">${result.title}</h3>
                <p class="text--date blue">${result.city}</p>
              </div>
            </li>
          </a>`)
        .join(``);
      $results.innerHTML = `<ul class="list">${items}</ul>`;
    }
  };

  init();
}
