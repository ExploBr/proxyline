<template lang="">
    <div>
        <div class="from-group" >

            <label for="title">Подзаголовок</label>
            <input class="form-control"
            value="" v-model="metas.podzagolovok"
            type="text"   id="podzagolovok">

            </div>

            <div class="from-group" >

            <label for="title">Контакты</label>
            <input class="form-control"
            value="" v-model="metas.contact"
            type="text"   id="contact">

        </div>
    </div>
</template>
<script>
export default {
    name: "ContactComponent",

    props:['metas']
}
</script>
<style lang="">
    
</style>