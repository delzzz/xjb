'use strict'
var userType = $('#h_userType').val();
if (userType == 3) {
  var userId = $('#vc_username').val(); //帐号
  var passWord = $('#vc_psd').val(); //密码
  var CONNECTION = {}
  var IMACCOUNT = {
    user:  userId,//'N1721SH00001W',
    pwd: passWord,//'1',
    token: ''
  }
  CONNECTION = new WebIM.connection({
    isMultiLoginSessions: WebIM.config.isMultiLoginSessions,
    https: typeof WebIM.config.https === 'boolean'
        ? WebIM.config.https
        : location.protocol === 'https:',
    url: WebIM.config.xmppURL,
    isAutoLogin: true,
    heartBeatWait: WebIM.config.heartBeatWait,
    autoReconnectNumMax: WebIM.config.autoReconnectNumMax,
    autoReconnectInterval: WebIM.config.autoReconnectInterval,
    apiUrl: WebIM.config.apiURL
  })

// listern，添加回调函数
  CONNECTION.listen({
    onOpened: function (message) {
      //连接成功回调，连接成功后才可以发送消息
      //如果isAutoLogin设置为false，那么必须手动设置上线，否则无法收消息
      // 手动上线指的是调用conn.setPresence(); 在本例中，conn初始化时已将isAutoLogin设置为true
      // 所以无需调用conn.setPresence();
      console.log('%c [opened] 连接已成功建立', 'color: green')
    },
    onOffline: function () {
      console.log('offline')
      CONNECTION.open(options)
    }, //本机网络掉线
    onError: function (message) {
      console.log('Error')
      console.log(message)
      if (message && message.type == 1) {
        console.warn('连接建立失败！请确认您的登录账号是否和appKey匹配。')
      }
    } //失败回调
  })
// 初始化WebRTC Call
  var rtcCall = null
  if (WebIM.WebRTC) {
    rtcCall = new WebIM.WebRTC.Call({
      connection: CONNECTION,

      mediaStreamConstaints: {
        audio: true,
        video: true
      },

      listener: {
        onAcceptCall: function (from, options) {
          // console.log('onAcceptCall::', 'from: ', from, 'options: ', options)
        },
        //对方的视频流
        onGotRemoteStream: function (stream, streamType) {
          console.log(
              'onGotRemoteStream::',
              'stream: ',
              stream,
              'streamType: ',
              streamType
          )
          var video = document.getElementById('video')
          video.srcObject = stream
        },
        //自己的视频流

        onGotLocalStream: function (stream, streamType) {
          //console.log('onGotLocalStream::', 'stream:', stream, 'streamType: ', streamType);
          var video = document.getElementById('localVideo')
          video.srcObject = stream
        },
        onRinging: function (caller) {
          //console.log('onRinging::', 'caller:', caller);
          var re = caller.match(/_(\S*)@/)[1]
          console.log(re)
          localStorage.setItem('DEVICE_CODE', re)
          $.ajax({
            type: 'GET',
            url: "/Admin/Userbasicfile/getAlertInfo.html",
            data:{'deviceIdentifier':re},
            success: function (data) {
              data = JSON.parse(data)
              localStorage.setItem('peopleId',data['peopleId'])
              $('.inBound .alarm_username').text(data['name'])
              $('.inBound .video_age').text(data['age'])
              if(data['imagePath'] !== '' && typeof (data['imagePath']) != "undefined"){
                $('.inBound .usePic').attr('src',data['imagePath'])
              }
            }
          });
        },
        onTermCall: function (reason) {
          console.log('onTermCall::', 'reason:', reason)
        },
        //连接状态改变
        onIceConnectionStateChange: function (iceState) {
          console.log(iceState, 'iceStateiceState')
          switch (true) {
            case iceState == 'connected':
              _imDom.webImWrap.show()
              _imDom.inBound.show()
              break
            case iceState == 'completed':
              _imDom.containerVideo.show()
              _imDom.inBound.hide()
              break
            case iceState == 'closed':
              _imDom.containerVideo.hide()
              _imDom.webImWrap.hide()
              _imDom.inBound.hide()
              localStorage.removeItem('DEVICE_CODE')
              break
          }
        },
        onError: function (e) {
          console.log(e)
        }
      }
    })
  } else {
    console.warn('不能进行视频通话！您的浏览器不支持webrtc或者协议不是https。')
  }

  var _imDom = {
    webImWrap: $('.webImWrap'),
    inBound: $('.inBound'), //呼入提示
    foreAcceptCall: $('#foreAcceptCall'), //呼入接听
    rtEndCall: $('#rtEndCall'), //挂断
    rtAcceptCall: $('#rtAcceptCall'), //接听
    rtCall: $('#rtCall'), //拨打
    containerVideo: $('.container_video') //视频窗口
  }

// open，登录
//1107170912178195#pension-demo
  WebIM.config.appkey = '1107170912178195#pension-test'
  var options = {}
  if (IMACCOUNT.token) {
    options = {
      user: IMACCOUNT.user,
      access_token: IMACCOUNT.token,
      apiUrl: WebIM.config.apiURL,
      appKey: WebIM.config.appkey
    }
  } else {
    options = {
      user: IMACCOUNT.user,
      pwd: IMACCOUNT.pwd,
      apiUrl: WebIM.config.apiURL,
      appKey: WebIM.config.appkey,
      success: function (res) {
        IMACCOUNT.token = res.access_token
        console.log(res)
      }
    }
  }

  CONNECTION.open(options)
}
/**
 *
 *
 * 视频呼叫对方
 * @param {string}  a:己方环信id,必须与登录id一致
 * @param {string} b:对方环信id
 */

function call(a, b) {
  rtcCall.caller = a
  rtcCall.makeVideoCall(b)
  localStorage.setItem('DEVICE_CODE', b)
}

//呼出
//console.log(_imDom.rtCall)
_imDom.rtCall.click(function() {
  _imDom.webImWrap.show()
  _imDom.containerVideo.show()
  //call('N1721SH00001W', '15855643250') //呼出调用
  loadIframe()
})

// 接受对方呼叫
_imDom.foreAcceptCall.click(function() {
  _imDom.containerVideo.show()
  _imDom.inBound.hide()
  rtcCall.acceptCall()
  loadIframe()
})

//挂断视频
_imDom.rtEndCall.click(function() {
  _imDom.webImWrap.hide()
  _imDom.containerVideo.hide()
  rtcCall.endCall()
})

var _demoElement = {
  tabsActive: $('#webImTab >li.active>a'),
  tabs: $('#webImTab >li'),
  iframe: $('.webImWrap .iframe')
}
function loadIframe() {
  // $(_demoElement.tabs).each(function() {
  //   $(this).removeClass('active')
  // })

  // var f = $(`[data-src = ${location.hash.replace(/#/, '')}]`)[0].parentElement
  // $(f).addClass('active')
  _demoElement.iframe.attr(
    'src',
      '/Admin/Public/'+_demoElement.tabsActive[0].dataset.src + '.html'
  )
}

_initIframe()
function _initIframe() {
  for (let i = 0; i < _demoElement.tabs.length; i++) {
    $(_demoElement.tabs[i]).click(function(e) {
      $(_demoElement.tabs).each(function() {
        $(this).removeClass('active')
      })
      $(this).addClass('active')
      _demoElement.iframe.attr('src', '/Admin/Public/'+e.target.dataset.src + '.html')
    })
  }
}

function add0(m) {
  return m < 10 ? '0' + m : m
}

function format(v) {
  var time = new Date(v)
  var y = time.getFullYear()
  var m = time.getMonth() + 1
  var d = time.getDate()
  var h = time.getHours()
  var mm = time.getMinutes()
  var s = time.getSeconds()
  return (
    y +
    '-' +
    add0(m) +
    '-' +
    add0(d) +
    ' ' +
    add0(h) +
    ':' +
    add0(mm) +
    ':' +
    add0(s)
  )
}
