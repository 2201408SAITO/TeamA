new Vue({
    el: '#app',
    data(){
        return{
            piece: 15,
            price: 40000
        };
    },
    computed:{
        isTan(){
          const price = this.price;
          const isErr = price.length > 6 || isNaN(Number(price));
          return isErr;
        },
        isKo(){
          const piece = this.piece;
          const isErr = piece.length > 4 || isNaN(Number(piece));
          return isErr;
      }
    }
  
  });