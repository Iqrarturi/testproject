<template>
<div class="modal" :class="openModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add Phone Record </p>
      <button class="delete" aria-label="close" @click="close('')"></button>
    </header>
    <section class="modal-card-body">
      <li class="panel-block">
      		<label class="column is-2"><b>Name</b></label>{{list.name}}
      </li>
	  <li class="panel-block">
      		<label class="column is-2"><b>Phone</b></label>{{list.phone}}
      </li>
	  <li class="panel-block">
      		<label class="column is-2"> <b>Email</b></label>{{list.email}}
      </li>
    </section>
    <footer class="modal-card-foot">
      
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
			list:{}
		}
	},

	methods:{
		close(){
			this.$emit('closeModal',"my message !");
		}
	}
	}
</script>