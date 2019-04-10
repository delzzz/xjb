var _socketCharts = {}
_socketCharts.max = 10
_socketCharts.heartRateXAxisData = [0, 0, 0, 0, 0, 0, 0, 0, 0]
_socketCharts.heartRateTime = []

_socketCharts.heartRateCurrent = $('.heartRate .latest .current span')
_socketCharts.heartRateStatus = $('.heartRate .latest .status span')
_socketCharts.heartRateChart = echarts.init(
  document.getElementById('heartRate')
)

_socketCharts.breatheXAxisData = [0, 0, 0, 0, 0, 0, 0, 0, 0]
_socketCharts.breatheTime = ['-', '-', '-', '-', '-', '-', '-', '-', '-']
_socketCharts.breatheCurrent = $('.breathe .latest .current span')
_socketCharts.breatheStatus = $('.breathe .latest .status span')
_socketCharts.breatheChart = echarts.init(document.getElementById('breathe'))

function request(peopleId, status) {
  return new Promise((resolve, reject) => {
  $.ajax({
    type: 'get',
    url: "../Userhealthreport/getFiveHeartOrBreath",
    contentType: 'application/json',
    data: {
      peopleId: peopleId,
      status: status //"1"为心率查询,"2"为呼吸查询
    },
    dataType: 'json',
    success: function (res) {
      resolve(res)

    },
    error: function (err) {
      reject(err)
    }
  })
  })
}
function setHeartRate(peopleId) {
  request(peopleId, 1).then(res => {
    heartRateStatus(
      res,
      _socketCharts.heartRateStatus,
      _socketCharts.heartRateCurrent
    )
    _socketCharts.heartRateXAxisData = res.data
    _socketCharts.heartRateTime = res.time
    let start =
      _socketCharts.heartRateTime[_socketCharts.heartRateTime.length - 10]
    let options = {
      grid: {
        left: '2%',
        right: '2%',
        top: '2%',
        bottom: '2%',
        containLabel: true
      },
      dataZoom: {
        filterMode: 'filter',
        zoomLock: true,
        show: true,
        type: 'slider',
        realtime: false,
        throttle: 0,
        startValue: start,
        endValue: _socketCharts.heartRateTime.length
      },

      xAxis: [
        {
          type: 'category',
          boundaryGap: true,
          data: _socketCharts.heartRateTime,
          axisLabel: {
            interval: 0,
            textStyle: {
              color: '#666666'
            },
            fontSize: 14
          }
        }
      ],
      yAxis: [
        {
          axisTick: {
            lineStyle: {
              opacity: 0
            }
          },
          axisLabel: {
            textStyle: {
              color: '#666666'
            },
            fontSize: 14
          },
          type: 'value',
          interval: 20, //设置分格
          scale: false,
          name: '',
          max: 200,
          min: 0,
          boundaryGap: [0.2, 0.2],
          splitLine: {
            show: false,
            lineStyle: {
              color: ['#efefef']
            }
          } //网格线
        }
      ],
      series: [
        {
          data: _socketCharts.heartRateXAxisData,
          type: 'bar',

          barCategoryGap: 0, //间隔
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: 'rgba(59,205,168,.1)'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 60
                },
                {
                  yAxis: 100
                }
              ]
            ]
          },
          color: function(params) {
            var colorList = [
              'rgba(51, 153, 255, 1)',
              'rgba(255, 204, 0, 1)',
              'rgba(255, 102, 0, 1)'
            ]
            if (params.value == 2) {
              return colorList[0]
            } else {
              if (params.value <= 19 || params.value > 140) {
                return colorList[2]
              } else if (
                (params.value >= 20 && params.value <= 59) ||
                (params.value >= 101 && params.value <= 140)
              ) {
                return colorList[1]
              } else {
                return colorList[0]
              }
            }
          }
        }
      ]
    }
    _socketCharts.heartRateChart.clear()
    _socketCharts.heartRateChart.setOption(options)
  })
}

function setBreathe(peopleId) {
  request(peopleId, 0).then(res => {
    breatheStatus(
      res,
      _socketCharts.breatheStatus,
      _socketCharts.breatheCurrent
    )
    _socketCharts.breatheXAxisData = res.data
    _socketCharts.breatheTime = res.time
    let options = {
      grid: {
        left: '2%',
        right: '2%',
        top: '2%',
        bottom: '2%',
        containLabel: true
      },
      dataZoom: {
        filterMode: 'filter',
        zoomLock: true,
        show: true,
        type: 'slider',
        realtime: false,
        throttle: 0,
        show: true,
        startValue:
          _socketCharts.breatheTime[_socketCharts.breatheTime.length - 10],
        endValue: _socketCharts.breatheTime.length
      },
      xAxis: [
        {
          type: 'category',
          boundaryGap: true,
          data: _socketCharts.breatheTime,
          axisLabel: {
            textStyle: {
              color: '#666666'
            },
            fontSize: 14
          }
        }
      ],
      yAxis: [
        {
          axisTick: {
            lineStyle: {
              opacity: 0
            }
          },
          axisLabel: {
            textStyle: {
              color: '#666666'
            },
            fontSize: 14
          },
          type: 'value',
          interval: 10, //设置分格
          scale: false,
          name: '',
          max: 40,
          min: 0,
          splitLine: {
            show: false,
            lineStyle: {
              color: ['#efefef']
            }
          } //网格线
        }
      ],
      series: [
        {
          data: _socketCharts.breatheXAxisData,
          type: 'bar',

          barCategoryGap: 0, //间隔
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: 'rgba(59,205,168,.1)'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 16
                },
                {
                  yAxis: 20
                }
              ]
            ]
          },
          color: function(params) {
            var colorList = [
              'rgba(51, 204, 153, 1)',
              'rgba(255, 204, 0, 1)',
              'rgba(255, 102, 0, 1)'
            ]
            if (params.value == 1) {
              return colorList[0]
            } else {
              if (params.value <= 11 || params.value > 25) {
                return colorList[2]
              } else if (
                (params.value >= 12 && params.value <= 15) ||
                (params.value >= 21 && params.value <= 24)
              ) {
                // console.log(params.value)
                return colorList[1]
              } else {
                return colorList[0]
              }
            }
          }
        }
      ]
    }
    _socketCharts.breatheChart.clear()
    _socketCharts.breatheChart.setOption(options)
  })
}

// function shift(xAxisData, time) {
//   if (xAxisData.length >= _socketCharts.max) {
//     xAxisData.shift()
//     time.shift()
//   }
// }

function heartRateStatus(res, status, current) {
  data = res.data[res.data.length - 1]
  if (data == 0) {
    current.attr('class', '')
    status.attr('class', '')
    status.text('无数据')
    current.text('-')
  } else {
    if (data <= 19 || data > 140) {
      current.attr('class', 'danger')
      status.attr('class', 'danger')
      if (data <= 19) {
        status.text('过缓')
      } else {
        status.text('过快')
      }
    } else if ((data >= 20 && data <= 59) || (data >= 101 && data <= 140)) {
      current.attr('class', 'warning')
      status.attr('class', 'warning')
      if (data >= 20 && data <= 59) {
        status.text('偏低')
      } else {
        status.text('偏快')
      }
    } else {
      status.attr('class', 'nomal')
      current.attr('class', 'nomal')
      status.text('正常')
    }
    current.text(data)
  }
}

function breatheStatus(res, status, current) {
  data = res.data[res.data.length - 1]
  if (data == 0) {
    current.attr('class', '')
    status.attr('class', '')
    status.text('无数据')
    current.text('-')
  } else {
    if (data <= 11 || data > 25) {
      current.attr('class', 'danger')
      status.attr('class', 'danger')
      if (data <= 11) {
        status.text('缓慢')
      } else {
        status.text('急促')
      }
    } else if ((data >= 12 && data <= 15) || (data >= 21 && data <= 24)) {
      current.attr('class', 'warning')
      status.attr('class', 'warning')
      if (data >= 12 && data <= 15) {
        status.text('偏低')
      } else {
        status.text('偏快')
      }
    } else {
      status.attr('class', 'nomal')
      current.attr('class', 'nomal')
      status.text('正常')
    }
    current.text(data)
  }
}
var peopleId = localStorage.getItem('peopleId');
var interval = 5 * 60 * 1000
setHeartRate(peopleId)
setBreathe(peopleId)
setInterval(function() {
  setHeartRate(peopleId)
  setBreathe(peopleId)
}, interval)
