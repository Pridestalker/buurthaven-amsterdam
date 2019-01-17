<template>
    <form method="POST" :action="url" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Evenement naam</label>
            <input type="text" id="title" placeholder="Evenement naam" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Omschrijving</label>
            <textarea id="description" placeholder="Omschrijving" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="startDate">Begindatum (en tijd)</label>
            <!--<input type="text" id="startDate" class="form-control">-->
            <date-picker v-model="startDate" type="datetime" lang="en" :minute-step="15" confirm format="YYYY-MM-DD hh:mm:ss"></date-picker>
        </div>
        <div class="form-group">
            <label for="endDate">Einddatum en tijd</label>
            <!--<input type="text" id="endDate" class="form-control">-->
            <date-picker v-model="endDate" type="datetime" lang="en" :minute-step="15" confirm format="YYYY-MM-DD hh:mm:ss"></date-picker>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input v-model="repeat" type="checkbox" name="repeat" id="repeat" class="custom-control-input">
                <label for="repeat" class="custom-control-label">Herhaalt dit evenement zich?</label>
            </div>
        </div>
        <div v-if="repeat" class="form-group">
            <span>Wanneer herhaalt dit evenement?</span>
    
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-mo" value="MO" class="custom-control-input">
                <label for="day-mo" class="custom-control-label">Maandag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-tu" value="TU" class="custom-control-input">
                <label for="day-tu" class="custom-control-label">Dinsdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-we" value="WE" class="custom-control-input">
                <label for="day-we" class="custom-control-label">Woendag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-th" value="TH" class="custom-control-input">
                <label for="day-th" class="custom-control-label">Donderdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-fr" value="FR" class="custom-control-input">
                <label for="day-fr" class="custom-control-label">Vrijdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-sa" value="SA" class="custom-control-input">
                <label for="day-sa" class="custom-control-label">Zaterdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="repeat" id="day-su" value="SU" class="custom-control-input">
                <label for="day-su" class="custom-control-label">Zondag</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" @change="onFileChange" accept="image/*">
                <label class="custom-file-label" for="customFile">Kies foto</label>
            </div>
        </div>
        <input type="hidden" id="action" v-model="this.action">
        <button type="submit">Aanmaken</button>
    </form>
</template>

<script>
    import DatePicker from 'vue2-datepicker'
    import axios from 'axios'
    
	export default {
		name: "new-event-component",
        components: {DatePicker},
        data: function() {
			return {
				repeat: false,
				repeat_days: [],
				startDate: null,
				endDate: null,
                image: null,
            }
        },
        props: {
			url: {
				default: '//buurthaven.amsterdam/wp-admin/admin-post.php',
            },
            action: {
				default: 'new_event',
            }
        },
        methods: {
			submitForm: function () {
				console.log(this.repeat);
				console.log(this.repeat_days);
				console.log(this.startDate);
				console.log(this.endDate);
				console.log(this.image);
                
                let sendme = {
                	'action': this.action,
					'repeat': this.repeat,
                    'days': this.repeat_days,
                    'start': this.startDate,
                    'end': this.endDate,
                    // 'img': this.image
                };
                
                axios.post(`${this.url}`, sendme)
                    .then(res => console.log(res))
                    .catch(err => console.log(err))
                
            },
			onFileChange(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				
				console.log(files);
				this.image = files[0];
			}
        }
	};
</script>

<style scoped>

</style>