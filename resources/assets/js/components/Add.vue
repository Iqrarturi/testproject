<template>
<div class="modal" :class="openModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add Phone Record <span class="has-text-info">{{message}}</span></p>
      <button class="delete" aria-label="close" @click="close('')"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
		  <label class="label">Name</label>
		  <div class="control">
		    <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model="list.name">
		  </div>
		  <small v-if="errors.name" class="has-text-danger">{{errors.name[0]}}</small>
	  </div>
	  <div class="field">
		  <label class="label">Phone</label>
		  <div class="control">
		    <input class="input" :class="{'is-danger':errors.phone}" type="text" placeholder="Phone" v-model="list.phone">
		  </div>
		  <small v-if="errors.phone" class="has-text-danger">{{errors.phone[0]}}</small>
	  </div>
	  <div class="field">
		  <label class="label">Email</label>
		  <div class="control">
		    <input class="input" :class="{'is-danger':errors.email}" type="text" placeholder="Email" v-model="list.email">
		  </div>
		  <small v-if="errors.email" class="has-text-danger">{{errors.email[0]}}</small>
	  </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click="save">Save Entry</button>
      <button class="button" @click="close('')">Cancel</button>
    </footer>
  </div>
</div>
</template>
<script>
	export default{
	props:['openModal'],

	data(){
		return{
			list:{
			name:'',
			phone:'',
			email:''
			},
			message:"",
			errors:{}
		}
	},
	
	methods:{
		close(message){
			this.message="";
			this.list.name="";
			this.list.phone="";
			this.list.email="";
			this.errors={};
			this.$emit('closeModal', message);
		},
		save(){
			axios.post('/phonebook',this.list)
  			.then((response)=>{
  				this.$parent.entries.push(response.data);
  				this.$parent.entries.sort(function(a,b){
  					if(a.name>b.name){
  						return 1;
  					}else if(a.name<b.name){
  						return -1;
  					}
  				});
    			this.list={name:"", phone:"", email:""};
    			this.errors={};
    			this.close("Created successfully !");
  				console.log(response.data);
  				}
  			)
 			 .catch((error)=> {
   			 	this.errors=error.response.data.errors;
  			});
		}
	}
	}
</script>