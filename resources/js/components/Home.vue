<template>
    <div>
        <div class="page">
          <div class="select-year">
               <form v-on:submit="viewHolidays($event)">
                 <div>
                    <label for="year">select year for your holidays</label>
                    <select name="year"  @change="selectYear($event)" v-model="selected" required>
                        <option value="">YEAR</option>
                        <option v-for="(year, index) in years" :key="index">{{ year }}</option>
                    </select>
                    <button type="submit" class="btn-display">View holidays</button>
                 </div>
              </form>
           </div>
           <div class="holiday-title">
              <h3>View Your Selected Year Holidays</h3>
           </div>
           <!-- check holiday length -->
           <div v-if="holidays.length > 0"> 
           <div class="holidays-table-header">
              <div class="holiday-header">
                <h4>Holiday Name</h4>
               </div>
              <div class="holiday-header">
                <h4>Holiday Date</h4>
              </div>
              <div class="holiday-header">
                <h4>Holiday Type</h4>
              </div>
           </div>
           <div v-for="(holiday, index) in holidays" :key="index" class="holiday-body">
              <div class="body">
                 <p>{{  holiday.name[1].text }}</p> 
              </div>
              <div class="body">
                <p>Day Of The Week Is  <span>{{ holiday.date.dayOfWeek }}</span></p> 
                <p>{{ holiday.date.day }}/{{ holiday.date.month }}/{{  holiday.date.year }}</p>
              </div>
               <div class="body">
                 <p>{{ holiday.holidayType }}</p> 
              </div>
           </div>
          </div>
           <!-- end if -->
           <!-- if no holidays -->
           <div v-if="holidays.length == 0">
             <div class="no-holidays">
                  <h1>There Are No Selected Holidays</h1>
                  <p>please select year and press the view holiday button</p>
             </div>
           </div>
           <!-- end if no holdays -->
            <div v-if="error">
             <div class="error">
                <p>{{ error }}</p>
             </div>
           </div>
         </div>
    </div>
</template>


<script>
import axios from "axios";
export default {
  name: "Home",
  data() {
    return {
      years: [],
      selected: "",
      holidays: [],
      error: ""
    };
  },
  created() {
    this.fillYears();
  },
  methods: {
    // fills the combo box with years
    fillYears() {
      let max_year = 2025;
      let min_year = 1900;
      const nr_of_element = max_year - min_year;
      let i = 0;
      while (i < nr_of_element + 1) {
        this.years[i] = max_year;
        max_year = max_year - 1;
        i = i + 1;
      }
    },
    // gets the selected year;
    selectYear(event) {
      this.selected = event.target.value;
    },
    // view holidays
    async viewHolidays(event) {
      event.preventDefault();
      try {
        let response = await axios.post("/api/holidays", {
          year: this.selected
        });
        console.log(response);
        this.holidays = response.data;
      } catch (error) {
        this.error = error;
        console.log("error is" + error);
      }
    }
  }
};
</script>

<style scoped>
.page {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  flex-wrap: wrap;
}
.page form {
  margin-top: 25px;
  padding: 5px;
}
.page form label {
  color: #114792;
  font-size: 16px;
  font-weight: 400;
  padding: 2px;
  margin: 10px;
  height: 30px;
  text-transform: uppercase;
}
.page form select {
  color: #114792;
  font-size: 14px;
  font-weight: 400;
  height: 30px;
  padding: 2px;
  margin: 10px 5px;
  border: 2px solid #114792;
  border-radius: 6px;
}
.page form select:hover {
  border: 2px solid #114792;
}
.page form .btn-display {
  background-color: #114792;
  font-size: 14px;
  font-weight: 400;
  color: #fff;
  height: 30px;
  width: 150px;
  padding: auto;
  margin: auto 10px;
  text-align: center;
  border: 2px solid #114792;
  border-radius: 6px;
  cursor: pointer;
  text-transform: uppercase;
}
.page form .btn-display:hover {
  color: #114792;
  background-color: #fff;
}
.holiday-title {
  background-color: #114792;
  margin: 0px;
  padding: 0px;
  height: 40px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.holiday-title h3 {
  color: #fff;
  font-size: 22px;
  font-weight: 500;
  text-align: center;
}
.holidays-table-header {
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
  grid-column-gap: 0.5rem;
  margin-top: 10px;
}
.holidays-table-header .holiday-header {
  color: #114792;
  height: 50px;
  text-align: center;
  padding: 10px;
}
.holidays-table-header .holiday-header h4 {
  font-size: 19px;
  font-weight: 700;
  text-transform: uppercase;
}
.holiday-body {
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
  grid-column-gap: 1.5rem;
  margin-top: 10px;
  border-top: 1px solid #ccc;
}
.holiday-body > .body:nth-child(2) {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 450px;
}
.holiday-body > .body:nth-child(1) {
  margin-left: 5%;
  display: flex;
  justify-content: flex-start;
  padding: 5px;
  width: 150px;
}
.holiday-body > .body:nth-child(3) {
  margin-left: 10%;
  justify-content: flex-start;
  padding: 5px;
  width: 150px;
}
.holiday-body .body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80px;
}
.holiday-body .body p {
  color: #111;
  font-size: 17px;
  font-weight: 600;
}
.no-holidays {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  flex-wrap: wrap;
  margin-top: 20px;
}
.no-holidays h1 {
  color: #114792;
  font-size: 30px;
  text-transform: uppercase;
}
.no-holidays p {
  color: #111;
  font-size: 17px;
  font-weight: 600;
}
.error {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  flex-wrap: wrap;
  margin-top: 20px;
}
.error p {
  color: #ff0000;
  font-size: 17px;
  font-weight: 600;
}

@media (max-width: 1024px) {
  .page form label {
    font-size: 14px;
  }
  .page form select {
    font-size: 13px;
  }
  .page form .btn-display {
    font-size: 13px;
  }
  .holiday-title h3 {
    font-size: 18px;
  }
  .holidays-table-header > .holiday-header:nth-child(1) {
    margin-left: -55%;
  }
  .holidays-table-header > .holiday-header:nth-child(3) {
    margin-left: 30%;
  }
  .holidays-table-header .holiday-header h4 {
    font-size: 16px;
  }
  .holiday-body .body p {
    font-size: 14px;
  }
  .no-holidays h1 {
    font-size: 20px;
  }
  .no-holidays p {
    font-size: 15px;
  }
}
@media (max-width: 786.77px) {
  .page form label {
    font-size: 13px;
  }
  .page form select {
    font-size: 12px;
  }
  .page form .btn-display {
    font-size: 12px;
  }
  .holiday-title h3 {
    font-size: 16px;
  }
  .holidays-table-header {
    display: none;
  }
  .holiday-body {
    grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
    margin-top: 25px;
    border-top: 2px solid #114792;
  }
  .holiday-body > .body:nth-child(1) {
    margin: 2% 30%;
    height: 20px;
    justify-content: center;
    align-items: center;
  }
  .holiday-body > .body:nth-child(2) {
    justify-content: center;
    align-items: center;
  }
  .holiday-body > .body:nth-child(3) {
    margin: 2% 30%;
    height: 20px;
    justify-content: center;
    align-items: center;
  }
  .no-holidays h1 {
    font-size: 18px;
  }
  .no-holidays p {
    font-size: 13.5px;
  }
}
@media (max-width: 580px) {
  .page form label {
    font-size: 12px;
  }
  .page form select {
    font-size: 11.5px;
  }
  .page form .btn-display {
    font-size: 11.5px;
  }
  .holiday-title h3 {
    font-size: 14px;
  }
  .holidays-table-header {
    display: none;
  }
  .holiday-body {
    grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
    margin-top: 25px;
    border-top: 2px solid #114792;
  }
  .holiday-body > .body:nth-child(1) {
    margin: 2% 30%;
    height: 20px;
    justify-content: center;
    align-items: center;
  }
  .holiday-body > .body:nth-child(2) {
    justify-content: center;
    align-items: center;
  }
  .holiday-body > .body:nth-child(3) {
    margin: 2% 30%;
    height: 20px;
    justify-content: center;
    align-items: center;
  }
  .no-holidays h1 {
    font-size: 15px;
  }
  .no-holidays p {
    font-size: 12px;
  }
}
</style>
