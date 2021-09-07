<template>
    <div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link
              class="nav-link"
              :to="{ name: 'productss' }"
            >
              Products
            </router-link>
          </li>

         
        </ul>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>