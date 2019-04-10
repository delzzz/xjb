'use strict'

var socket = io.connect('https://push.yewu.cishoo.com/')
//var socket = io.connect('http://192.168.1.107:3001')

socket.on('/push/cishuo/DEVICE_ALARM', function(res) {
  var res = JSON.parse(res)
  var DEVICE_CODE = localStorage.getItem('DEVICE_CODE') || ''
  var deviceCode = res.deviceCode

  var alarmType = ''
  switch (res.alarmType) {
    case 0:
      alarmType = 'SOS紧急警报'
      break
    case 1:
      alarmType = '呼叫报警'
      break
    case 2:
      alarmType = '呼吸急促'
      break
    case 3:
      alarmType = '呼吸缓慢'
      break
    case 4:
      alarmType = '心率过快'
      break
    case 5:
      alarmType = '心率缓慢'
      break
  }
  var livingString = ''
  switch (res.livingStatus) {
    case 0:
      livingString = '一人居'
      break
    case 1:
      livingString = '二老居'
      break
    case 2:
      livingString = '一人保姆居'
      break
    case 3:
      livingString = '二老保姆居'
      break
    case 4:
      livingString = '子女同居'
      break
    case 5:
      livingString = '孙辈同居'
      break
    case 6:
      livingString = '其他'
      break
    default:
      livingString = '-'
  }
  if ($('.webImWrap .container_video').css('display') === 'block') {
    if (DEVICE_CODE == deviceCode) {
      $('#profile-tab').attr('class', 'physicalWarning')
      setTimeout(function() {
        $('#profile-tab').attr('class', '')
      }, 4000)
    }
  } else {
    $('.webImWrap').show()
    $('.webImWrap .equipmentAlarm').show()
    $('.equipmentAlarm .img img').attr('src', res.photo)
    $('.equipmentAlarm .info .name').text(res.name)
    $('.equipmentAlarm .info .age').text(res.age + '岁')
    $('.equipmentAlarm .info .situation').text(livingString)
    $('.equipmentAlarm .info .address').text(res.address)
    $('.equipmentAlarm .type .reason').text(alarmType)
    $('.equipmentAlarm .click').empty()
    var html = `<a style='color: #fff' href="/Admin/Warning/warning_current/alarmId/${res.alarmId}/deviceIdentifier/${deviceCode}.html">查看详情</a>`
    $('.equipmentAlarm .click').html(html)
  }
})
// http://192.168.1.245:877/?id=DEVICE_ALARM

// 报警类型 0 SOS紧急警报 1呼叫报警 2呼吸急促 3 呼吸缓慢 4心率过快 5心率缓慢
