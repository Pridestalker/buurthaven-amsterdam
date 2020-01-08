<template>
    <form method="POST" :action="url" @submit="submitForm" enctype="multipart/form-data">
        <div class="alert alert-success" role="alert" v-if="success">
            Jouw activiteit is aan ons doorgegeven.
        </div>
        <div class="alert alert-danger" role="alert" v-if="failure">
            Er is iets fout gegaan met het aanmaken.
            Waren alle velden ingevuld?
        </div>
        <h2>Activiteit aanmaken</h2>
        <div class="form-group">
            <label for="title">Naam activiteit</label>
            <input type="text" name="title" id="title" placeholder="Naam activiteit" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Omschrijving</label>
            <textarea id="description" name="description" placeholder="Omschrijving" class="form-control" rows="3" />
        </div>
        <div class="form-group">
            <label for="startDate" class="d-block">Begindatum (en tijd)</label>
            <date-picker v-model="startDate" name="startDate" type="datetime" :minute-step="15" confirm value-type="timestamp" format="YYYY-MM-DD hh:mm:ss" :lang="lang"/>
        </div>
        <div class="form-group">
            <label for="endDate" class="d-block">Einddatum (en tijd)</label>
            <date-picker v-model="endDate" name="endDate" type="datetime" :minute-step="15" confirm value-type="timestamp" format="YYYY-MM-DD hh:mm:ss" :lang="lang"/>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input v-model="repeat" type="checkbox" name="repeat" id="repeat" class="custom-control-input">
                <label for="repeat" class="custom-control-label">Wil je deze activiteit vaker organiseren?</label>
            </div>
        </div>
        <div v-if="repeat" class="form-group">
            <span>Op welke dagen?</span>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-mo" id="day-mo" value="MO" class="custom-control-input">
                <label for="day-mo" class="custom-control-label">Maandag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-tu" id="day-tu" value="TU" class="custom-control-input">
                <label for="day-tu" class="custom-control-label">Dinsdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-we" id="day-we" value="WE" class="custom-control-input">
                <label for="day-we" class="custom-control-label">Woendag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-th" id="day-th" value="TH" class="custom-control-input">
                <label for="day-th" class="custom-control-label">Donderdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-fr" id="day-fr" value="FR" class="custom-control-input">
                <label for="day-fr" class="custom-control-label">Vrijdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-sa" id="day-sa" value="SA" class="custom-control-input">
                <label for="day-sa" class="custom-control-label">Zaterdag</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input v-model="repeat_days" type="checkbox" name="day-su" id="day-su" value="SU" class="custom-control-input">
                <label for="day-su" class="custom-control-label">Zondag</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" @change="onFileChange" accept="image/*">
                <label class="custom-file-label" for="thumbnail"><span v-if="image">{{ image.name }}</span><span v-else>Kies foto</span></label>
            </div>
        </div>
        <input type="hidden" id="action" name="action" v-model="action">
        <input type="hidden" id="user" name="user" v-model="user">
        <input type="hidden" id="startDate" name="startDate" v-model="startDate">
        <input type="hidden" id="endDate" name="endDate" v-model="endDate">
        <button type="submit" class="btn bg-blue">Aanmaken</button>
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
                
                sendme: {},
                
                success: false,
                failure: false,

				lang: {
					days: [ 'Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za' ],
					months: [ 'Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec' ],
					placeholder: {
						date: 'Kies een datum',
					}
				}
            }
        },
        props: {
			url: {
				default: '//buurthaven.amsterdam/wp-admin/admin-post.php?action=new_event',
            },
            action: {
				default: 'new_event',
            },
            user: {
				type: Number,
                default: null
            }
        },
        methods: {
			submitForm: function () {
                
                this.sendme = {
					'repeat': this.repeat,
                    'days': this.repeat_days,
                    'start': this.startDate,
                    'end': this.endDate,
                    'img': this.image
                };
                
                axios.post(`${this.url}`, this.sendme, { headers: {'Content-Type': 'multipart/form-data' }})
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
        },
        mounted() {
			let urlparams = new URLSearchParams(window.location.search);
			if( urlparams.get('success') === '1') {
				this.success = true;
            }
			
			if( urlparams.get('fail') === '1') {
				this.failure = true;
            }
		}
	};
</script>

<style scoped>
    label {
        font-weight: bold;
    }
    
    .bg-blue {
        background: var(--blue);
        color: #fff;
    }
    .custom-file-label::after {
        content: "Kies"
    }
</style>
