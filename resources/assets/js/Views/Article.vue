<style></style>

<template>
<v-layout row wrap>
    <v-flex xs12 class="text-xs-center" v-if="loading">
    	<v-progress-circular 
		    indeterminate 
		    v-bind:size="50" 
		    class="primary--text" 
		  />
    </v-flex>
    <v-flex xs12 v-if="article">
	    <h1>
	        {{ article.title }}
	    </h1>
	    <h3>{{ article.short_description }}</h3>
	    <h6>Create: {{ article.created_at }}, Update: {{ article.updated_at }}</h6>
	    <p v-markdown:content="article.content"></p>
	    <v-card>
	        <v-card-row class="blue darken-1">
	            <v-card-title>
	                <p class="white--text">
	                	Categories:
	                	<span v-for="(category, index) in article.categories">
	                		{{ category.category.name }}
	                	</span>
	                </p>
	            </v-card-title>
	        </v-card-row>
	        <v-card-row class="blue darken-1">
	            <v-card-title>
	                <span class="white--text">{{ article.author.name }}</span>
	                <v-spacer></v-spacer>
	            </v-card-title>
	        </v-card-row>
	    </v-card>
    </v-flex>
</v-layout>
</template>

<script>
// import { mapActions } from 'vuex'

export default {
	name: 'article',
	data () {
		return {
			article: null,
			loading: true
		}
	},
	created () {
        this.fetch()
    },
	methods: {
		// ...mapActions(['notify']),
		fetch () {
			this.loading = true
			this.$http.get('/api/articles/' + this.$route.params.link).then((res) => {
				var data = res.body

				if (data.success) {
					this.article = data.article
				}
			}).catch((err) => {
				if (!err.success) {
					// this.notify({ msg: err.msg, show: true })
				}
				this.$router.push({ name: 'home' })
			}).then(() => {
				this.loading = false
			})
		}
	},
	watch: {
		'$route': 'fetch'
	}
}
</script>