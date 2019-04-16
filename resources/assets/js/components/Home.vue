<template>
  <div>
    	<nav class="panel column is-offset-2 is-8">
      <p class="panel-heading">
        <span>VueJs PhoneBook</span>
        <button class="button is-primary is-outlined " @click="openAdd">
          Add New
        </button>
        <h1 id="myTest">Click for API Test</h1>
        <button class="button is-primary is-outlined " @click="apiTest">
          test
        </button>
        <span class="is-pulled-right has-text-info" v-if="loading">
          <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
        </span>
        <h1 class="has-text-info">{{message}}</h1>
      </p>
      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input is-small" type="text" placeholder="search" v-model="squery">
          <span class="icon is-small is-left">
            
          </span>
        </p>
      </div>
      
      <a class="panel-block" v-for="entry, key in temp">
        <span class=" column is-9">
          {{entry.name}}
        </span>
        

        <span class="panel-icon column is-1">

          <i class="fa fa-trash has-text-danger" aria-hidden="true" @click="del(key, entry.id)"></i>

        </span>

        <span class="panel-icon column is-1">

          <i class="fa fa-edit has-text-info" aria-hidden="true" @click="openUpdate(key)"></i>

        </span>
        <span class="panel-icon column is-1">

          <i class="fa fa-eye has-text-primary" aria-hidden="true" @click="openShow(key)"></i>

        </span>
      </a>
      
      <Add :openModal="addActive" @closeModal="closeAdd"></Add>
      <Show :openModal="showActive" @closeModal="closeShow"></Show>
      <Update :openModal="updateActive" @closing="closeUpdate"></Update>
      
    </nav>
</div>

  </template>
<script>
let Add= require('./Add.vue');
let Show= require('./Show.vue');
let Update= require('./Update.vue');
//let Update= require('./Update.vue');
export default{
  
  data(){
    return{
    addActive : "",
    showActive : "",
    updateActive : "",
    loading:false,
    message:"",
    entries:{},
    temp:{},
    errors:{},
    squery:""
    }
  },
  mounted(){
    this.loading=!this.loading;
    axios.get('/getdata')
        .then((response)=>{
            this.entries=this.temp=response.data;
            //console.log(this.entries);
            this.loading=!this.loading;
          
          }
        )
       .catch((error)=> {
          this.errors=error.response.data.errors;
        });
  },
  watch:{
    squery(){
      // console.log(this.squery);

      if(this.squery.length>0){
        //this.temp=this.entries;
         this.temp=this.entries.filter((item)=>{
          return Object.keys(item).some((key)=>{
            let string=String(item[key]);
            return string.toLowerCase().indexOf(
            this.squery.toLowerCase())>-1;
          })
        
       });
        
      }else{  
        this.temp=this.entries; 
      }
      
    }
  },
  components:{Add,Show, Update},

  methods:{  
    apiTest(){
       $.ajax({
          method: "GET",
          url: "http://laramulti.test/api/users",
          headers:{'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBmMTFmMjNiOWJlYTVkNTdjMzZiNTIyOTVlODQzZGI3ZDc3YjA0ODVjZDA3MjViODc0Y2YxNDUxNTg3MWY5OWNkYzgxNTJlMzA3NGY2OGE4In0.eyJhdWQiOiIyIiwianRpIjoiMGYxMWYyM2I5YmVhNWQ1N2MzNmI1MjI5NWU4NDNkYjdkNzdiMDQ4NWNkMDcyNWI4NzRjZjE0NTE1ODcxZjk5Y2RjODE1MmUzMDc0ZjY4YTgiLCJpYXQiOjE1NTI0MDk1NjgsIm5iZiI6MTU1MjQwOTU2OCwiZXhwIjoxNTg0MDMxOTY4LCJzdWIiOiIxOCIsInNjb3BlcyI6WyIqIl19.i-ojtnJd_VV58dSLD3QZYPzrL7rzOM2iiMoQ-Mc--Og-TkJsnxyi_U5JDG7dZ1Z_hD5AU-kxyvy6_jTOiimyVlqnvLA6v_I5b3zESP2_QSdpIwhYN1DTdBWF9XUoBwLI4y_j04PLcN-2olAa-0EAUrO3rnFLvKeLHJOBKi4yV2pmksFTtVQxS_pv6Ma0xqS3wXWeCDZXVCRoPkSr_nfNIwJwo_VBzMB1id_G3Jo9HfkdQfYmnO_0WxVGsfFgCQv-xv1NXRupaf3XntHicEhLuX8hlhkYuRKNJ9EJDiixsremQkIwCUNzQ8K-7lgvqU5Za14wJCS7tU8UHvokNRE4yuafoLmFyhvxZPIo6V4VB9jDgpQNK8BlB1LT88AI8YA40FwrxIH_T31z7YQJnAuQ-r70_JV4uoLJd64Aw9BtBnxmstVL-l80ClBbvLD98q1wnprO9JoStt1xCINBgXdZ7qZS4NwEN_E4OOnq4ZUgM-zQnrnG9LGnCpA6lhsHMJrlWtq1JFIT3ES_pg2DPAB3QAte-IefZOayi4DvcIkaoDgQKDRxHmhi26U4cz6Kjb5o9TSVUAef8hE9JVQ7YcLM6MTp_7AaUKfVYfJEs1hMFC-GQqr0xjrndXpIx744IqWuidlPSIAGmyOoBuVgtVl3CUoOyH11mYKnpe1gqZnkWPE',
          'Accept':'application/json',

        },
        })
        .done(function( msg ) {
          console.log(msg);
        });
      //$("#myTest").html("this is from source");
     /* .log('i am clicked..');
      axios.get('http://laramulti.test/api/users',{
        params:{api_token:}
      })
      .then((response)=>{
        console.log(response.data);
      })
      .catch((error)=>{
        console.log(error);
      });*/
    }, 
    openAdd(){
      this.addActive="is-active";
    },
    openShow(key){
      this.showActive="is-active";
      //console.log(key);
      this.$children[1].list=this.temp[key];
    },
    openUpdate(key){
      this.updateActive="is-active";
      this.$children[2].list=this.entries[key];
      //console.log(this.entries[key]);
    },
    closeAdd(value){
    this.addActive="";
    
    
    this.message=value;
    },
    closeShow(){
      this.showActive="";
      this.$children[1].list={};
    },
    closeUpdate(){
      this.updateActive="";
    
      this.$children[2].list={};
    },
    del(key, id){

      //console.log(id);
        //var myid=id;
        //console.log(myid);
        if(confirm("Are you sure to Delete ?")){
          this.loading=!this.loading;
          axios.delete(`/phonebook/${id}`)
          .then((response)=>{
              this.temp.splice(key,1);
              this.loading=!this.loading;
              console.log(response.data);
            }
          )
         .catch((error)=> {
            this.errors=error.response.data.errors;
          });
        }
      
      
    }

  }
}
</script>