<template>
	<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
	    <a class="navbar-item" href="https://bulma.io">
	      Turi Vue
	    </a>
	    <div class="navbar-menu is-active">
	    <router-link to="/home" class="navbar-item is-active">Home</router-link>
	    <router-link to="/about" class="navbar-item">About</router-link>
	    
    </div>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="true">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
    
  </div>
</nav>
</template>