'use strict'
var DEVICE_CODE = localStorage.getItem('DEVICE_CODE')
// var DEVICE_CODE = 'N1705JY25874E'
// DEVICE_CODE = 'SIGN_DATA'
//var socket = io.connect('http://192.168.1.107:3001')
var socket = io.connect('http://192.168.1.245:877')
var _socketCharts = {}
_socketCharts.max = 10
_socketCharts.heartRateXAxisData = [0, 0, 0, 0, 0, 0, 0, 0, 0]
_socketCharts.heartRateTime = ['-', '-', '-', '-', '-', '-', '-', '-', '-']

_socketCharts.heartRateCurrent = $('.heartRate .latest .current span')
_socketCharts.heartRateStatus = $('.heartRate .latest .status span')
_socketCharts.heartRateChart = echarts.init(
  document.getElementById('heartRate')
)
_socketCharts.heartRateOption = {
  grid: {
    left: '2%',
    right: '2%',
    top: '2%',
    bottom: '2%',
    containLabel: true
  },
  xAxis: [
    {
      type: 'category',
      boundaryGap: true,
      data: _socketCharts.heartRateTime,
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
  ]
}
_socketCharts.breatheXAxisData = [0, 0, 0, 0, 0, 0, 0, 0, 0]
_socketCharts.breatheTime = ['-', '-', '-', '-', '-', '-', '-', '-', '-']
_socketCharts.breatheCurrent = $('.breathe .latest .current span')
_socketCharts.breatheStatus = $('.breathe .latest .status span')
_socketCharts.breatheChart = echarts.init(document.getElementById('breathe'))
_socketCharts.breatheOption = {
  grid: {
    left: '2%',
    right: '2%',
    top: '2%',
    bottom: '2%',
    containLabel: true
  },
  legend: {
    data: ['']
  },
  dataZoom: {
    show: false,
    start: 0,
    end: 100
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
  ]
}

socket.on('/push/cishuo/' + DEVICE_CODE, function(res) {
  var res = JSON.parse(res)
  heartRateStatus(_socketCharts.heartRateStatus, _socketCharts.heartRateCurrent)

  shift(_socketCharts.heartRateXAxisData, _socketCharts.heartRateTime)
  _socketCharts.heartRateXAxisData.push(res.heartRate)
  _socketCharts.heartRateTime.push(res.timeStr)
  _socketCharts.heartRateChart.setOption(_socketCharts.heartRateOption)

  breatheStatus(_socketCharts.breatheStatus, _socketCharts.breatheCurrent)

  shift(_socketCharts.breatheXAxisData, _socketCharts.breatheTime)
  _socketCharts.breatheXAxisData.push(res.breathing)
  _socketCharts.breatheTime.push(res.timeStr)
  _socketCharts.breatheChart.setOption(_socketCharts.breatheOption)

  function shift(xAxisData, time) {
    if (xAxisData.length >= _socketCharts.max) {
      xAxisData.shift()
      time.shift()
    }
  }
  function heartRateStatus(status, current) {
    if (res.breathing == 0) {
      current.attr('class', '')
      status.attr('class', '')
      status.text('-')
      current.text('-')
    } else {
      if (res.heartRate <= 19 || res.heartRate > 140) {
        current.attr('class', 'danger')
        status.attr('class', 'danger')
        if (res.heartRate <= 19) {
          status.text('过缓')
        } else {
          status.text('过快')
        }
      } else if (
        (res.heartRate >= 20 && res.heartRate <= 59) ||
        (res.heartRate >= 101 && res.heartRate <= 140)
      ) {
        current.attr('class', 'warning')
        status.attr('class', 'warning')
        if (res.heartRate >= 20 && res.heartRate <= 59) {
          status.text('偏低')
        } else {
          status.text('偏快')
        }
      } else {
        status.attr('class', 'nomal')
        current.attr('class', 'nomal')
        status.text('正常')
      }
      current.text(res.heartRate)
    }
  }
  function breatheStatus(status, current) {
    if (res.breathing == 0) {
      current.attr('class', '')
      status.attr('class', '')
      status.text('-')
      current.text('-')
    } else {
      if (res.breathing <= 11 || res.breathing > 25) {
        current.attr('class', 'danger')
        status.attr('class', 'danger')
        if (res.breathing <= 11) {
          status.text('缓慢')
        } else {
          status.text('急促')
        }
      } else if (
        (res.breathing >= 12 && res.breathing <= 15) ||
        (res.breathing >= 21 && res.breathing <= 24)
      ) {
        current.attr('class', 'warning')
        status.attr('class', 'warning')
        if (res.breathing >= 12 && res.breathing <= 15) {
          status.text('偏低')
        } else {
          status.text('偏快')
        }
      } else {
        status.attr('class', 'nomal')
        current.attr('class', 'nomal')
        status.text('正常')
      }
      current.text(res.breathing)
    }
  }
})
