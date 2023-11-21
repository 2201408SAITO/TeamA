new Vue({
    el:'#app',
    data() {
      return {
        activeTab: 1, // アクティブなタブ
      }
    },
    computed: {
      // 商品名で絞り込むタブがアクティブ
      acitiveWordsTab() {
        return  this.activeTab===1
      },
      // 価格で絞り込むタブがアクティブ
      acitivePriceTab () {
        return  this.activeTab===2
      },  
    },
    methods: {
      // タブを切り替え
      changeTab (number) {
        this.activeTab = number
      },
    },
   
  })
  