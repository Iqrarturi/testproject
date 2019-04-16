<template>
	<div class="modal" :class="openModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Edit Record </p>
      <button class="delete" aria-label="close" @click="close"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
		  <label class="label">Name</label>
		  <div class="control">
		    <input class="input" type="text" placeholder="Name" v-model="list.name" :class="{'is-danger':errors.name}">
		  </div>
		  <small v-if="errors.name" class="has-text-danger">{{errors.name[0]}}</small>
	  </div>
	  <div class="field">
		  <label class="label">Phone</label>
		  <div class="control">
		    <input class="input"  type="text" placeholder="Phone" v-model="list.phone" :class="{'is-danger':errors.phone}">
		  </div>
		  <small v-if="errors.phone" class="has-text-danger">{{errors.phone[0]}}</small>
	  </div>
	  <div class="field">
		  <label class="label">Email</label>
		  <div class="control">
		    <input class="input"  type="text" placeholder="Email" v-model="list.email" :class="{'is-danger':errors.email}">
		  </div>
		  <small v-if="errors.email" class="has-text-danger">{{errors.email[0]}}</small>
	  </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click="update">Save changes</button>
      <button class="button" @click="close">Cancel</button>
    </footer>
  </div>
</div>
</template>
<script>
	export default{

		props:['openModal'],
		data(){
			return{
				list:{},
				errors:{}
			}
		},
		methods:{
			close(){
				//this.openModal="";
				this.$emit('closing');
				this.list.name="";
				this.list.phone="";
				this.list.email="";
				this.errors={};
				//console.log("update cloase is working");
			},
			update(){
				axios.patch('/phonebook/{this.list.id}',this.list)
  				.then((response)=>{
  					this.close();
  					//console.log(response.data);
	    			// this.message=response.data;
	    			// this.list={name:"", phone:"", email:""};
	    			// this.errors={};
	    			// this.close("Created successfully !");
	  				//console.log(this.list);
  				}
  				)
 			 .catch((error)=> {
 			 	this.errors=error.response.data.errors;
   			 	console.log(error.response.data.errors.name);
  			});
			}
		}
	}
</script>