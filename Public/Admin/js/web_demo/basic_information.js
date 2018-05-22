_show($('.basic_information .healthInfo'), $('.basic_information .moreBtn'))

function _show(container, btn) {
  var height = container.css('height')
  var flag = true
  container.css('height', '0')
  btn.click(function() {
    if (flag) {
      container.css('height', height)
      btn.text('收起更多数据')
    } else {
      container.css('height', '0')
      btn.text('查看更多数据')
    }
    flag = !flag
  })
}
