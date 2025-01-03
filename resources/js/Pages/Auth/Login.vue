<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit">
            <div class="mb-3">
                <InputLabel for="email" value="E-mail" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                />

                <InputError class="mt-2 text-danger" :message="form.errors.email" />
            </div>

            <div class="mb-3">
                <InputLabel for="password" value="Senha" />

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                />

                <InputError class="mt-2 text-danger" :message="form.errors.password" />
            </div>

            <div class="d-flex justify-content-end mt-4 align-items-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-muted text-decoration-none me-3"
                >
                    Esqueceu sua senha?
                </Link>

                <PrimaryButton
                    :class="{ 'disabled': form.processing }"
                    :disabled="form.processing"
                >
                    Entrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
