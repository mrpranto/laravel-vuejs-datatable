<template>
    <div class="card">
        <div class="card-header h5">
            Laravel Server Side Data Table
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    <select class="form-select form-select-sm" v-model="paginate" aria-label=".form-select-sm example">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>5
                    </select>
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="id" placeholder="Id...">
                </div>
                <div class="col-1">
                    <select class="form-select form-select-sm" v-model="classInfo" aria-label=".form-select-sm example">
                        <option value="">Classes</option>
                        <option v-for="(class_info, index) in classes" :key="index" :value="class_info.id">{{ class_info.class_name }}</option>
                    </select>
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="name" placeholder="Name...">
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="phone" placeholder="Phone...">
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="email" placeholder="Email...">
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="age" placeholder="Age...">
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="address" placeholder="Address...">
                </div>
                <div class="col-1">
                    <input class="form-control form-control-sm" type="text" v-model.lazy="search" placeholder="Search...">
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary" type="button" @click.prevent="downloadPdf">PDF</button>
                    <button class="btn btn-sm btn-success" type="button" @click.prevent="downloadExcel">Excel</button>
                    <button class="btn btn-sm btn-info" type="button" @click.prevent="downloadCsv">CSV</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <template v-for="(col, index) in columns">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" @click="columnHide" :value="col.data" :id="col.data">
                            <label class="form-check-label" :for="col.data">
                                {{ col.title }}
                            </label>
                        </div>
                    </template>

                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" v-for="(col, index) in columns" v-if="!hide_columns.includes(col.data)" :key="index">
                                <a href="#" @click.prevent="changeSort(col.data, 'asc')" class="sort">&uarr;</a> {{ col.title }} <a href="#"  @click.prevent="changeSort(col.data, 'desc')" class="sort">&darr;</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(student, index) in students.data" :key="index">
                            <td scope="col" v-for="(col, index) in columns"  v-if="!hide_columns.includes(col.data)" :key="index">{{ col.data === 'class_info' ? student.class_info.class_name : student[col.data] }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <pagination align="center" :data="students" @pagination-change-page="getStudents">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
export default {
    name: "DatatableComponent",
    components:{
        pagination
    },
    data(){
        return {
            id: '',
            classInfo: '',
            name: '',
            phone: '',
            email: '',
            age: '',
            address: '',
            column_name: '',
            students: {},
            classes: [],
            hide_columns: [],
            paginate: 10,
            search: '',
            order_by: 'id',
            order_dir: 'desc',
            columns: [
                {
                    title: 'ID',
                    data: 'id'
                },
                {
                    title: 'Class',
                    data: 'class_info'
                },
                {
                    title: 'Name',
                    data: 'name'
                },
                {
                    title: 'Phone',
                    data: 'phone'
                },
                {
                    title: 'Email',
                    data: 'email'
                },
                {
                    title: 'Age',
                    data: 'age'
                },
                {
                    title: 'Address',
                    data: 'address'
                },
            ],
        }
    },
    mounted() {
        this.getStudents()
        this.getClasses()
    },
    watch:{
        paginate: function (){
            this.getStudents()
        },
        search: function (){
            this.getStudents()
        },
        order_dir: function (){
            this.getStudents()
        },
        order_by: function (){
            this.getStudents()
        },
        id:function (){
            this.getStudents()
        },
        classInfo:function (){
            this.getStudents()
        },
        name:function (){
            this.getStudents()
        },
        phone:function (){
            this.getStudents()
        },
        email:function (){
            this.getStudents()
        },
        age:function (){
            this.getStudents()
        },
        address:function (){
            this.getStudents()
        }
    },
    methods:{
        getClasses(){
            axios.get('/api/class-info')
                .then(response => {
                    this.classes = response.data
                })
                .catch(err => console.log(err))
        },
        getStudents(page = 1){
            axios.get('/api/students?page='+page
                +'&paginate='+this.paginate
                +'&search='+this.search
                +'&id='+this.id
                +'&classInfo='+this.classInfo
                +'&name='+this.name
                +'&phone='+this.phone
                +'&email='+this.email
                +'&age='+this.age
                +'&address='+this.address
                +'&order_by='+this.order_by
                +'&order_dir='+this.order_dir
            )
                .then(response => {
                    this.students = response.data
                })
                .catch(err => console.log(err))
        },
        columnHide(){
            const column = event.target.value;
            if (!this.hide_columns.includes(column)){
                this.hide_columns.push(column)
            }else {
               let colum_index = this.hide_columns.indexOf(column)
                this.hide_columns.splice(colum_index, 1)
            }
        },
        changeSort(column, dir){
            console.log(column, dir)
            this.order_by = column;
            this.order_dir = dir
        },
        async downloadPdf(){
            await window.open('/api/download-pdf?hide_col='+this.hide_columns)
        },
        async downloadExcel(){
            await window.open('/api/download-excel?hide_col='+this.hide_columns)
        },
        async downloadCsv(){
            await window.open('/api/download-csv?hide_col='+this.hide_columns)
        }
    }
}
</script>

<style scoped>
    .column_disable{
        background-color: #767b80;
        color: white;
    }
    .sort{
        text-decoration: none;
        color: black;
    }
</style>
