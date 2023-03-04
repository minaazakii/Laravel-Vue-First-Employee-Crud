import axios from "axios"


export default {

    async saveEmployee(payload,context)
    {
     const response = await axios.post("api/save-employee",context)
        return{
            response: response
        }
    },
    async getEmployees({commit},payload)
    {
        const response = await axios.get("/api/get-employees");
        // console.log(response)
        commit('setEmployee',response.data)
    },
    async updateEmployee(payload,context)
    {
        const id = context.id;
        const response = await axios.put("/api/update-employee/"+id,context);
        return response
    },
    async deleteEmployee(payload,context)
    {
        const response = await axios.delete("/api/delete-employee/"+context)
        return response
    }
}
