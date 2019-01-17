<template>
    <form @submit.prevent="submitForm">
        <div class="form-group">
            <label for="title">Evenement naam</label>
            <input type="text" id="title" placeholder="Evenement naam" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Omschrijving</label>
            <textarea id="description" placeholder="Omschrijving" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input v-model="repeat" type="checkbox" name="repeat" id="repeat" class="custom-control-input">
                <label for="repeat" class="custom-control-label">Herhaalt dit evenement zich?</label>
            </div>
        </div>
        <div class="form-group">
            <label for="startDate">Begindatum (en tijd)</label>
            <!--<input type="text" id="startDate" class="form-control">-->
            <date-picker v-model="startDate" lang="en" id="startDate" minute-step="15"></date-picker>
        </div>
        <div class="form-group">
            <label for="endDate">Einddatum en tijd</label>
            <!--<input type="text" id="endDate" class="form-control">-->
            <date-picker v-model="endDate" lang="en" id="endDate" minute-step="15"></date-picker>
        </div>
        <div v-if="repeat" class="form-group">
            <label for="days">Wanneer is dit evenement?</label>
            <select name="days" id="days" multiple v-model="days" class="form-control">
                <option value="MO">Maandag</option>
                <option value="TU">Dinsdag</option>
                <option value="WE">Woensdag</option>
                <option value="TH">Donderdag</option>
                <option value="FR">Vrijdag</option>
                <option value="SA">Zaterdag</option>
                <option value="SU">Zondag</option>
            </select>
        </div>
        <button type="submit">Aanmaken</button>
    </form>
</template>

<script>
    import DatePicker from 'vue2-datepicker'
    
	export default {
		name: "new-event-component",
        components: {DatePicker},
        data() {
			return {
				repeat: false,
                days: null,
                startDate: null,
                endDate: null
            }
        },
        methods: {
			submitForm: function () {
				console.log(repeat);
				console.log(days);
				console.log(startDate);
				console.log(endDate)
            }
        }
	};
</script>

<style scoped>

</style>