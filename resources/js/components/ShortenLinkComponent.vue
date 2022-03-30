<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shorten URL Generator</div>

                    <div class="card-body">
                        <label class="mb-3">Please enter the URL here...</label>
                       <input type="text" class="form-control" v-model="url">

                        <a v-if="shorten_url" :href="shorten_url" class="form-control mt-5" target="_blank">{{shorten_url}}</a>
                        <button class="btn btn-primary mt-4 float-end" @click.prevent="submitUrl">Generate</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                url:'',
                oldUrl:'',
                shorten_url:'',
            }
        },
        methods:{
            submitUrl(){
                if(this.url == this.oldUrl)
                {
                    alert('Shorten URL for this link is already generated!');
                }
                else
                {
                    axios.post('/shorten-url-generator',null,{
                        params:{
                            url:this.url
                        }
                    }).then((data)=>{
                        this.shorten_url=data.data.shorten_url
                        this.oldUrl=this.url

                    }).catch(()=>{

                        alert('WRONG URL')

                    })

                }


            }
        }
    }
</script>
