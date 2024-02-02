<template>
  <canvas :id="id" :style="style"></canvas>
</template>
<script>
import {onMounted} from "vue";
import Chart from 'chart.js/auto';

// import Chart from 'chart.js/dist/chart.js'

export default {
  props: {
    dataSets: Object,
    id: String,
    chartType: String,
    options: Object,
    labels: Object,
    updateColor: Object,
    fillet: Object,
    style: String
  },

  watch: {
    dataSets: {
      handler: function (newVal) {
        this.updateChart()
      },
      deep: true
    },
  },
  setup(props) {
    let myChart
    let colors = {
      dark: {
        bg: '',
        text: 'rgb(232,232,232)',
        line: 'rgba(77,77,77,0.2)',
        tickColor: 'rgba(189,17,17,0.2)'
      },
      light: {
        bg: '',
        text: 'rgb(87,87,87)',
        line: 'rgba(47,47,47,0.2)',
        tickColor: 'rgba(224,23,23,0.2)'
      }
    }
    const darkMode_event = () => {
      setUpColors(localStorage.getItem('color-theme'))
      window.addEventListener('themeChange', (e) => {
        setUpColors(e.detail.theme)
        myChart.update()
      })
    }
    const setUpColors = (key) => {
        if (!props.options) return   myChart.update()
      myChart.options.plugins.legend.labels.color = colors[key].text
        if ( Object.values(props.options.scales).length>0){
          myChart.options.scales.y.grid.color = colors[key].line
          myChart.options.scales.x.grid.color = colors[key].line
        }
      myChart.update()
    }

    const _myChart = () => {
      const ctx = document.getElementById(props.id).getContext('2d');
      myChart = new Chart(ctx, {
        type: props.chartType || 'bar',
        data: {
          labels: props.labels,
          datasets: props.dataSets
        },
        options: props.options
      });
    }
    const updateChart = () => {
      myChart.data.labels = props.labels
      myChart.data.options = props.options
      myChart.data.datasets = props.dataSets
      myChart.update()
    }

    onMounted(() => {
      _myChart()
      darkMode_event()
    })

    return {
      myChart,
      updateChart
    }
  }

}
</script>

