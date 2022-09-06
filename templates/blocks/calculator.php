<div class="calculator">
  <div class="grid-container">
    <form class="calculator_form">
      <div class="calculator_top">
        <div class="calculator_heading heading">Калькулятор подбора бытовки</div>
        <div class="calculator_wrap">
          <div class="calculator_block">
            <select class="select">
              <option></option>
              <option value="storage">Бытовка склад</option>
              <option value="office">Бытовка прорабская (офис)</option>
              <option value="living">Бытовка жилая</option>
              <option value="security">Бытовка пост охрана</option>
            </select>
          </div>
          <div class="calculator_block">
            <div class="calculator_input">
              <label class="input"><span>Количество:</span>
                <input class="number" type="text" name="count">
              </label>
            </div>
            <div class="calculator_input">
              <label class="input"><span>Срок аренды:<span>(мес)</span></span>
                <input class="number" type="text" name="rent">
              </label>
            </div>
          </div>
          <div class="calculator_block pay">
            <label class="radio">
              <input type="radio" name="pay">
              <div class="radio-text">Помесячная оплата</div>
            </label>
            <label class="radio">
              <input type="radio" name="pay">
              <div class="radio-text">Разовая оплата</div>
            </label>
          </div>
          <div class="calculator_block delivery">
            <label class="checkbox">
              <input type="checkbox">
              <div class="checkbox-text">Доставка</div>
            </label>
            <label>
              <input class="number" type="text" disabled name="distance"><span>километров до объекта</span>
            </label>
          </div>
        </div>
      </div>
      <div class="calculator_bottom">
        <div class="calculator_price">Выберите тип оплаты
          <!--span="35 000 Р/мес"-->
        </div>
        <div class="calculator_button"><a class="btn_pink" href="#" data-open="popup_order">Заказать</a></div>
      </div>
    </form>
  </div>
</div>