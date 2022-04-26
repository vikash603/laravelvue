<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add</div>

                    <div class="card-body">
                        <input type="text" v-model="todo_input"><br><br>
  <button v-if="!edit_todo_id" type="button" class="btn btn-info" @click="saveTodo()">Add</button>

   <button v-else type="button" class="btn btn-info" @click="UpdateTodo()">Update </button>
                    </div>

                    <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(todo,index) in todos" :key="index">
        <td>{{ ++index
        }}</td>
        <td>{{todo.name}}</td>
        <td><button type="button" class="btn btn-primary" @click="editTodo(--index)">Edit</button></td><td> <button type="button" class="btn btn-danger" @click="deleteTodo(--index)">Delete</button></td>
      </tr>
      
    </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                todos:[],
                api:'http://localhost:8000/api/todos',
                todo_input:'',
                edit_todo_id:'',
                edit_index:'',

            }
        },
        mounted() {
            this.axios.get(this.api).then(res =>{
                this.todos = res.data;
            });
        },
        methods:{
        saveTodo(){
            if (this.todo_input.length > 0 ){
                 this.axios.post(this.api,{'name': this.todo_input}).then(res =>{
                this.todos.push(res.data);
                this.todo_input='';
            });
            }
        },
        deleteTodo(index){
       if(this.todos[index].id){
        this.axios.delete(this.api+'/'+this.todos[index].id).then(res =>{
            this.todos.splice(index,1);

        })
       }
        },

        editTodo(index){
            if(this.todos[index].id){
                this.todo_input=this.todos[index].name;
            }
        }

    }

    }
</script>
