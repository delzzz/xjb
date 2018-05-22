'use strict'
// 获取拿到数据的日期
function _getSleepDate(arr) {
  var tmepArr = []
  for (var i = 0; i < arr.length; i++) {
    var time = arr[i].time
    tmepArr.push(time)
  }
  return tmepArr
}

// arr 是拿到的数据  k 是一个字符串  输出传入k值的数组
// var deep = _getSleepDuration(arr, 'deep_time')
// console.log(deep)
function _getSleepDuration(arr, k) {
  var tmepArr = []
  for (var i = 0; i < arr.length; i++) {
    for (var key in arr[i]['data']) {
      if (arr[i]['data'].hasOwnProperty(key)) {
        if (key == k) {
          var ele = arr[i]['data'][key]
          tmepArr.push(ele)
        }
      }
    }
  }
  return tmepArr
}
var _elements = {
  heartRateBtn: $('.heartRate .moreBtn'),
  heartRateBefore: $('.heartRate .before'),
  breatheBtn: $('.breathe .moreBtn'),
  breatheBefore: $('.breathe .before'),
  heartRateSelect: $('.heartRate .select'),
  breatheSelect: $('.breathe .select'),
  sleepSelect: $('.sleep .select'),
  heartRateCurrent: $('.heartRate .before .current>span'),
  breatheCurrent: $('.breathe .before .current>span'),
  sleepCurrent: $('.sleep .current>span'),
  heartRateStatus: $('.heartRate .before .status>span'),
  breatheStatus: $('.breathe .before .status>span'),
  sleepStatus: $('.sleep .status>span'),
  heartRateS: $('.heartRate .before .current>strong'),
  breatheS: $('.breathe .before .current>strong'),
  sleepS: $('.sleep .current>strong')
}
var _setStatus = {
  heartRate: function(n) {
    if (n == null) return false
    if (n <= 19 || n > 140) {
      _elements.heartRateCurrent.attr('class', 'danger')
      _elements.heartRateStatus.attr('class', 'danger')
      if (n <= 19) {
        _elements.heartRateStatus.text('过缓')
      } else {
        _elements.heartRateStatus.text('过快')
      }
    } else if ((n >= 20 && n <= 59) || (n >= 101 && n <= 140)) {
      _elements.heartRateStatus.attr('class', 'warning')
      _elements.heartRateStatus.attr('class', 'warning')
      if (n >= 20 && n <= 59) {
        _elements.heartRateStatus.text('偏低')
      } else {
        _elements.heartRateStatus.text('偏快')
      }
    } else {
      _elements.heartRateStatus.attr('class', 'nomal')
      _elements.heartRateCurrent.attr('class', 'nomal')
      _elements.heartRateStatus.text('正常')
    }
    _elements.heartRateCurrent.text(n)
  },
  breathe: function(n) {
    if (n == null) return false
    if (n <= 11 || n > 25) {
      _elements.breatheCurrent.attr('class', 'danger')
      _elements.breatheStatus.attr('class', 'danger')
      if (n <= 11) {
        _elements.breatheStatus.text('缓慢')
      } else {
        _elements.breatheStatus.text('急促')
      }
    } else if ((n >= 12 && n <= 15) || (n >= 21 && n <= 24)) {
      _elements.breatheCurrent.attr('class', 'warning')
      _elements.breatheStatus.attr('class', 'warning')
      if (n >= 12 && n <= 15) {
        _elements.breatheStatus.text('偏低')
      } else {
        _elements.breatheStatus.text('偏快')
      }
    } else {
      _elements.breatheStatus.attr('class', 'nomal')
      _elements.breatheCurrent.attr('class', 'nomal')
      _elements.breatheStatus.text('正常')
    }
    _elements.breatheCurrent.text(n)
  },
}

var _charts = {}
_charts.beforeHeartRateChart = echarts.init(
  document.getElementById('beforeHeartRate')
)
_charts.beforeBreatheChart = echarts.init(
  document.getElementById('beforeBreathe')
)
_charts.sleepChart = echarts.init(document.getElementById('sleep'))

_charts.beforeHeartRate = function(time, list) {
  var option = {
    grid: {
      left: '2%',
      right: '2%',
      top: '2%',
      bottom: '0%',
      containLabel: true
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
        data: time,
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
        data: list,
        type: 'line',
        symbol: 'circle',
        symbolSize: '10',
        connectNulls: false, //连接空数据
        barCategoryGap: 0, //间隔
        label: {
          normal: {
            show: true,
            position: 'top'
          }
        },
        lineStyle: {
          normal: {
            width: '2'
          }
        },
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
        itemStyle: {
          normal: {
            lineStyle: {
              color: '#6699FF'
            }
          }
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
  return option
}
_charts.beforeBreathe = function(time, list) {
  var option = {
    grid: {
      left: '2%',
      right: '2%',
      top: '2%',
      bottom: '0%',
      containLabel: true
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
        data: time,
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
        data: list,
        type: 'line',
        symbol: 'circle',
        symbolSize: '10',
        connectNulls: false, //连接空数据
        barCategoryGap: 0, //间隔
        label: {
          normal: {
            show: true,
            position: 'top'
          }
        },
        lineStyle: {
          normal: {
            width: '2'
          }
        },
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
        itemStyle: {
          normal: {
            lineStyle: {
              color: '#6699FF'
            }
          }
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
  return option
}
_charts.sleep = function(array) {
  _charts.sleepChart.clear()
  //睡眠质量数据
  function getSleepData(array) {
    var style = [
      {
        height: 20, //深睡高度
        color: 'rgba(102, 153, 153, 1)'
      },
      {
        height: 30, //浅睡高度
        color: 'rgba(102, 204, 255, 1)'
      },
      {
        height: 40, //清醒高度
        color: 'rgba(102, 255, 255, 1)'
      }
    ]
    var tempCount = 0 //缓存上次结果
    var timeBlock = 60
    var temp = {}
    var count = -1
    var len = array.length
    for (var i = 0; i < len; i++) {
      count++
      var arr = []
      var num = -1
      for (var k in array[i]['data']) {
        num++
        var element = array[i]['data'][k]
        // 0 0+ 10  10 10+ 20  10+20  10+20+ 30
        arr.push([
          tempCount,
          tempCount + element,
          style[num].height,
          style[num].color
        ])
        if (k == 'seepSleep') {
          tempCount = element + timeBlock * count
        } else {
          tempCount = tempCount + element
        }
      }
      temp[array[i]['time']] = arr
    }
    return temp
  }
  var xAxisData = getSleepData(array)

  var series = []
  var xAxisCount = []
  for (var key in xAxisData) {
    xAxisCount.push(key)
    var obj = {
      type: 'custom',
      data: xAxisData[key],
      barCategoryGap: 0, //间隔

      renderItem: function(params, api) {
        var yValue = api.value(2)
        var start = api.coord([api.value(0), yValue])
        var size = api.size([api.value(1) - api.value(0), yValue])
        var style = api.style()
        return {
          type: 'rect',
          shape: {
            x: start[0],
            y: start[1],
            width: size[0],
            height: size[1]
          },
          style: style
        }
      },
      encode: {
        x: [0, 1],
        y: 2
        // 表示『维度2』和『维度3』要显示到 tooltip 中。
        //tooltip: [2, 3]
      },
      color: function(params) {
        return params.value[3]
      }
    }
    series.push(obj)
  }
  var option = {
    grid: {
      left: '0%',
      right: '2%',
      top: '2%',
      bottom: '0%',
      containLabel: true
    },
    dataZoom: {
      show: false,
      start: 0,
      end: 100
    },
    xAxis: {
      interval: 60,
      axisTick: {
        lineStyle: {
          opacity: 0.5
        }
      },
      splitLine: {
        show: false,
        lineStyle: {
          color: ['#efefef']
        }
      }, //网格线
      axisLabel: {
        fontSize: 14,
        align: 'center',
        formatter: function(val, index) {
          return xAxisCount[index]
        }
      }
    },
    yAxis: [
      {
        show: false,
        type: 'value',
        scale: false,
        name: '',
        min: 0,
        max: 40,
        splitLine: {
          show: false
        } //网格线
      }
    ],
    series: series
  }
  return option
}

_charts.beforeSleep = function(time, deep, simple, wake) {
  _charts.sleepChart.clear()
  var xAxisData = [
    {
      name: '深睡',
      type: 'bar',
      stack: 'sleep',
      color: 'rgba(102, 153, 153, 1)',
      data: deep
    },
    {
      name: '浅睡',
      type: 'bar',
      stack: 'sleep',
      color: 'rgba(102, 204, 255, 1)',
      data: simple
    },
    {
      name: '清醒',
      type: 'bar',
      stack: 'sleep',
      color: 'rgba(102, 255, 255, 1)',
      data: wake
    }
  ]
  var option = {
    grid: {
      left: '0%',
      right: '2%',
      top: '2%',
      bottom: '0%',
      containLabel: true
    },
    xAxis: [
      {
        type: 'category',
        // boundaryGap: [0, 0.1],
        data: time,
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
        splitLine: {
          show: false
        } //网格线
      }
    ],
    yAxis: [
      {
        axisTick: {
          lineStyle: {
            opacity: 0
          }
        },
        show: true,
        name: '',
        min: 0,
        max: 600,
        interval: 60,
        axisLine: { onZero: true },
        type: 'time',
        splitLine: {
          show: false
        }, //网格线
        axisLabel: {
          fontSize: 14,
          formatter: function(value, index) {
            var texts = []
            texts.push(index + '小时')
            return texts
          }
        }
      }
    ],
    series: xAxisData
  }
  return option
}






