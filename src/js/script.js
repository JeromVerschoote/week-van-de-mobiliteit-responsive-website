{
  const $dayInput = document.querySelector(`[name="day"]`);
  const $tagInput = document.querySelector(`[name="tag"]`);
  const $locationInput = document.querySelector(`[name="locatie"]`);
  const $results = document.getElementById(`results`);
  const $noJSElements = document.querySelectorAll(`.noJS`);
  const $form = document.querySelector(`.newsletter-form`);
  const $filterForm = document.querySelector(`.programma-filters`);
  const $inputs = [$dayInput, $tagInput, $locationInput];

  const init = () => {
    handleProgressiveEnhancement();
    //handleSlideshow();

    if($form){
      $form.addEventListener(`submit`, handleSubmitEmail);
    }

    if($filterForm){
      if($inputs){
        addHandlerListeners($inputs);
      }
      loadAllEvents();
    }
  };

  const handleProgressiveEnhancement = () => {
    $noJSElements.forEach($element => {
      $element.classList.add(`hidden`);
    });
  };

  /*const handleSlideshow = () => {
    const $frame = document.querySelector(`.event-image`);

    if($frame){
      const index = 3;
      const style = $frame.getAttribute(`style`);
      const newStyle = style.replace(`1.webp`, `${index}.webp`);
      $frame.setAttribute(`style`, newStyle);
    }

  };*/

  const addHandlerListeners = elements => {
    elements.forEach($element => {
      $element.addEventListener(`input`, handleInputFilter);
    });
  };

  const handleSubmitEmail = e => {
    e.preventDefault();
    fetch($form.getAttribute(`action`), {
      headers: new Headers({
        Accept: `application/json`,
      }),
      method: `post`,
      body: new FormData($form),
    })
      .then(r => r.json())
      .then(data => handleLoadSubmit(data));
  };

  const handleLoadSubmit = data => {
    const $errorText = document.querySelector(`.error--text`);
    $errorText.textContent = `Je bent succesvol ingeschreven!`;
    if (data.result !== `ok`) {
      if (data.errors.text) {
        $errorText.textContent = data.errors.text;
      }
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
            <li class="list-item" style="background-image: url(./assets/images/${result.code}/1.webp)">
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
