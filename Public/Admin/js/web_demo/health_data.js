'use strict'
function formatDate(v) {
  var time = new Date(v)
  var y = time.getFullYear()
  var m = time.getMonth() + 1
  var d = time.getDate()
  return y + '年' + m + '月' + d + '日'
}
var _options = {
  bp: function(time, highList, lowList) {
    var option = {
      grid: {
        left: '2%',
        right: '2%',
        top: '2%',
        bottom: '0%',
        containLabel: true
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
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          min: 20,
          max: 300,
          interval: 40, //设置分格
          nameTextStyle: {
            fontSize: 100
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          },
          axisLabel: {
            textStyle: {
              color: '#666666',
              fontSize: 14
            }
          },
          splitLine: {
            show: true,
            lineStyle: {
              color: ['#efefef']
            }
          } //网格线
        }
      ],
      series: [
        {
          name: '收缩压(mmHg)',
          type: 'line',
          symbol: 'circle',
          symbolSize: '6',
          smooth: false, //平滑
          connectNulls: false, //连接空数据
          lineStyle: {
            normal: {
              width: '2'
            }
          },
          label: {
            normal: {
              show: true,
              position: 'top'
            }
          },
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: '#F2F9F0'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 90
                },
                {
                  yAxis: 139
                }
              ]
            ]
          },
          itemStyle: {
            normal: {
              lineStyle: {
                color: '#91C87B'
              }
            }
          },
          color: function(params) {
            var colorList = ['#91C87B', 'rgba(255, 102, 0, 1)']
            if (params.value < 90 || params.value > 139) {
              return colorList[1]
            } else {
              return colorList[0]
            }
          },
          data: highList
        },
        {
          name: '舒张压(mmHg)',
          type: 'line',
          symbolSize: '6',
          symbol: 'circle',
          lineStyle: {
            normal: {
              width: '2'
            }
          },
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: '#F6F8FE'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 60
                },
                {
                  yAxis: 89
                }
              ]
            ]
          },
          connectNulls: false, //连接空数据
          label: {
            normal: {
              show: true,
              position: 'bottom'
            }
          },
          itemStyle: {
            normal: {
              lineStyle: {
                color: '#7997F1'
              }
            }
          },
          color: function(params) {
            var colorList = ['#7997F1', 'rgba(255, 102, 0, 1)']
            if (params.value < 60 || params.value > 89) {
              return colorList[1]
            } else {
              return colorList[0]
            }
          },
          data: lowList
        }
      ]
    }
    return option
  },
  bg: function(time, before, after) {
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
          axisTick: {
            lineStyle: {
              opacity: 0
            }
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          },
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
          type: 'value',
          min: 0,
          max: 20,
          interval: 2, //设置分格
          nameTextStyle: {
            fontSize: 100
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          },
          axisLabel: {
            textStyle: {
              color: '#666666'
            },
            fontSize: 14
          },
          splitLine: {
            show: true,
            lineStyle: {
              color: ['#efefef']
            }
          } //网格线
        }
      ],
      series: [
        {
          name: '餐前',
          type: 'line',
          symbol: 'circle',
          symbolSize: '6',
          smooth: false, //平滑
          connectNulls: false, //连接空数据
          lineStyle: {
            normal: {
              width: '2'
            }
          },
          label: {
            normal: {
              show: true,
              position: 'top'
            }
          },
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: '#EDF6FD'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 3.9
                },
                {
                  yAxis: 6.1
                }
              ]
            ]
          },
          itemStyle: {
            normal: {
              lineStyle: {
                color: '#ACD1F3'
              }
            }
          },
          color: function(params) {
            var colorList = ['#ACD1F3', '#FF6600']
            if (params.value < 3.9 || params.value > 6.1) {
              return colorList[1]
            } else {
              return colorList[0]
            }
          },
          data: before
        },
        {
          name: '餐后',
          type: 'line',
          symbolSize: '6',
          symbol: 'circle',
          lineStyle: {
            normal: {
              width: '2'
            }
          },
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: '#ECECFD'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 6.7
                },
                {
                  yAxis: 9.4
                }
              ]
            ]
          },
          connectNulls: false, //连接空数据
          label: {
            normal: {
              show: true,
              position: 'bottom'
            }
          },
          itemStyle: {
            normal: {
              lineStyle: {
                color: '#9EA0F1'
              }
            }
          },
          color: function(params) {
            var colorList = ['#9EA0F1', '#FF6600']
            if (params.value < 6.7 || params.value > 9.4) {
              return colorList[1]
            } else {
              return colorList[0]
            }
          },
          data: after
        }
      ]
    }
    return option
  },
  bo: function(time, list) {
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
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          min: 60,
          max: 100,
          interval: 10, //设置分格
          nameTextStyle: {
            fontSize: 100
          },
          axisLine: {
            lineStyle: {
              color: '#efefef'
            }
          },
          splitLine: {
            show: true,
            lineStyle: {
              color: ['#efefef']
            }
          }, //网格线
          axisLabel: {
            textStyle: {
              color: '#666666'
            },
            fontSize: 14,
            formatter: function(value, index) {
              var texts = []
              texts.push(value + '%')
              return texts
            }
          }
        }
      ],
      series: [
        {
          type: 'line',
          symbol: 'circle',
          symbolSize: '6',
          smooth: false, //平滑
          connectNulls: false, //连接空数据
          lineStyle: {
            normal: {
              width: '2'
            }
          },
          label: {
            normal: {
              show: true,
              position: 'top'
            }
          },
          markArea: {
            silent: true,
            itemStyle: {
              normal: {
                color: '#FDF9F6'
              }
            },
            data: [
              [
                {
                  name: '',
                  yAxis: 100
                },
                {
                  yAxis: 90
                }
              ]
            ]
          },
          itemStyle: {
            normal: {
              lineStyle: {
                color: '#ACD1F3'
              }
            }
          },
          color: function(params) {
            var colorList = ['#ACD1F3', 'rgba(255, 102, 0, 1)']
            if (params.value < 90 || params.value > 100) {
              return colorList[1]
            } else {
              return colorList[0]
            }
          },
          data: list
        }
      ]
    }
    return option
  }
}
var _charts2 = {
  bp: echarts.init(document.getElementById('bloodPressure')),
  bg: echarts.init(document.getElementById('bloodGlucose')),
  bo: echarts.init(document.getElementById('bloodOxygen'))
}
var _selects = {
  bp: $('.bloodPressure .select'),
  bg: $('.bloodGlucose .select'),
  bo: $('.bloodOxygen .select')
}
var _current = {
  bpH: $('.bloodPressure .current>.shrinkage span'), //收缩
  bpL: $('.bloodPressure .current>.diastolic span'), //舒张
  bpB: $('.bloodGlucose .current>.before span'), //前
  bpA: $('.bloodGlucose .current>.after span'), //后
  bo: $('.bloodOxygen .current span'),
  bpD: $('.bloodPressure .current>p:nth-of-type(1)'),
  bgD: $('.bloodGlucose .current>p:nth-of-type(1)'),
  boD: $('.bloodOxygen .current>p:nth-of-type(1)')
}
var _status = {
  bpH: $('.bloodPressure .current>.shrinkage strong'), //收缩
  bpL: $('.bloodPressure .current>.diastolic strong'), //舒张
  bpB: $('.bloodGlucose .current>.before strong'), //前
  bpA: $('.bloodGlucose .current>.after strong'), //后
  bo: $('.bloodOxygen .current strong')
}

var _setStatus2 = {
  bp: function(h, l) {
    if (h != null) {
      if (h < 90 || h > 139) {
        _status.bpH.attr('class', 'danger')
        if (h < 90) {
          _status.bpH.text('（偏低）')
        } else {
          _status.bpH.text('（偏高）')
        }
      } else {
        _status.bpH.attr('class', 'nomal')
        _status.bpH.text('（正常）')
      }
    }
    if (l != null) {
      if (l < 60 || l > 90) {
        _status.bpL.attr('class', 'danger')
        if (l < 60) {
          _status.bpL.text('（偏低）')
        } else {
          _status.bpL.text('（偏高）')
        }
      } else {
        _status.bpL.attr('class', 'nomal')
        _status.bpL.text('（正常）')
      }
    }
    _current.bpH.text(h)
    _current.bpL.text(l)
  },

  bg: function(a, b) {
    if (a != null) {
      if (a < 6.7 || a > 9.4) {
        _status.bpA.attr('class', 'danger')
        if (a < 6.7) {
          _status.bpA.text('（偏低）')
        } else {
          _status.bpA.text('（偏高）')
        }
      } else {
        _status.bpA.attr('class', 'nomal')
        _status.bpA.text('（正常）')
      }
    }
    if (b != null) {
      if (b < 3.9 || b > 6.1) {
        _status.bpB.attr('class', 'danger')
        if (b < 3.9) {
          _status.bpB.text('（偏低）')
        } else {
          _status.bpB.text('（偏高）')
        }
      } else {
        _status.bpB.attr('class', 'nomal')
        _status.bpB.text('（正常）')
      }
    }
    _current.bpA.text(a)
    _current.bpB.text(b)
  },
  bo: function(n) {
    if (n == null) return false
    if (n < 90) {
      _status.bo.text('（偏低）')
      _status.bo.attr('class', 'danger')
    } else {
      _status.bo.text('（正常）')
      _status.bo.attr('class', 'nomal')
    }
    _current.bo.text(n)
  }
}
var _setOptions = {
  /**
   *
   *
   * @param {Array} time x轴坐标即日期
   * @param {Array} highList 高压 收缩压
   * @param {Array} lowList 低压
   */
  bp: function(time, highList, lowList) {
    var option = _options.bp(time, highList, lowList)
    _charts2.bp.setOption(option)
  },
  /**
   *
   *
   * @param {Array} time x轴坐标即日期
   * @param {Array} before 餐前 血糖
   * @param {Array} after 餐后
   */
  bg: function(time, before, after) {
    var option = _options.bg(time, before, after)
    _charts2.bg.setOption(option)
  },
  /**
   *
   *
   * @param {Array} time x轴坐标即日期
   * @param {Array} list 血氧
   */
  bo: function(time, list) {
    var option = _options.bo(time, list)
    _charts2.bo.setOption(option)
  }
}
function _judgeState(status, dom) {
  switch (status) {
    case '过轻':
      dom.addClass('warning')
      dom.text('过轻')

      break
    case '正常':
      dom.addClass('nomal')
      dom.text('正常')

      break
    case '过重':
      dom.addClass('warning')
      dom.text('过重')

      break
    case '肥胖':
      dom.addClass('danger')
      dom.text('肥胖')

      break
    case '非常肥胖':
      dom.addClass('danger')
      dom.text('非常肥胖')
      break
  }
}
/**
 *
 *
 * @param {any} timeStamp 时间戳
 * @param {any} status 正常 胖瘦 这些状态
 * @param {any} exp 本次指数
 * @param {any} height 身高
 * @param {any} weight 体重
 */
function _setBMI(timeStamp, status, exp, height, weight) {
  $('.bmi .name>span').text(formatDate(timeStamp))
  $('.bmi .exp>span').text(exp)
  $('.bmi .height>span').text(height)
  $('.bmi .weight>span').text(weight)
  _judgeState(status, $('.bmi .exp strong'))
}















