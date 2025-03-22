<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faDiscord, faTwitch, faXbox, faPlaystation, faWindows } from '@fortawesome/free-brands-svg-icons';
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    platform: '',
    recommended_by: '',
    discord: '',
    twitch: '',
    platform_username: '',
});

const getPlatformLabel = (platform) => {
    switch (platform) {
        case 'Xbox':
            return 'GamerTag';
        case 'PC':
            return 'Origin';
        case 'Playstation':
            return 'PlayStation Network';
        default:
            return '';
    }
};

const getPlatformIcon = (platform) => {
    switch (platform) {
        case 'Xbox':
            return faXbox;
        case 'PC':
            return faWindows;
        case 'Playstation':
            return faPlaystation;
        default:
            return null;
    }
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4">
                <div class="relative">
                    <select
                        id="platform"
                        v-model="form.platform"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pr-10"
                        required
                    >
                        <option value="">Select your platform</option>
                        <option value="Playstation" class="flex items-center gap-2">
                            <InputLabel for="platform" value="PS" />
                        </option>
                        <option value="Xbox" class="flex items-center gap-2">
                            <InputLabel for="platform" value="X" />
                        </option>
                        <option value="PC" class="flex items-center gap-2">
                            PC
                        </option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <FontAwesomeIcon :icon="faChevronDown" class="h-4 w-4 text-gray-400" />
                    </div>
                </div>

                <InputError class="mt-2" :message="form.errors.platform" />
            </div>

            <div class="mt-4" v-if="form.platform">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <FontAwesomeIcon :icon="getPlatformIcon(form.platform)" :class="{'text-xbox': form.platform === 'Xbox', 'text-playstation': form.platform === 'Playstation', 'text-windows': form.platform === 'PC'}" />
                    </div>
                    <TextInput
                        :id="form.platform.toLowerCase() + '_username'"
                        type="text"
                        class="mt-1 block w-full pl-10"
                        v-model="form.platform_username"
                        :placeholder="'Enter your ' + getPlatformLabel(form.platform) + ' username'"
                        required
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.platform_username" />
            </div>

            <div class="mt-4">
                <InputLabel for="discord" value="Discord Username" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <FontAwesomeIcon :icon="faDiscord" class="text-discord" />
                    </div>
                    <TextInput
                        id="discord"
                        type="text"
                        class="mt-1 block w-full pl-10"
                        v-model="form.discord"
                        placeholder="Enter your Discord username"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.discord" />
            </div>

            <div class="mt-4">
                <InputLabel for="twitch" value="Twitch Username" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <FontAwesomeIcon :icon="faTwitch" class="text-twitch" />
                    </div>
                    <TextInput
                        id="twitch"
                        type="text"
                        class="mt-1 block w-full pl-10"
                        v-model="form.twitch"
                        placeholder="Enter your Twitch username"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.twitch" />
            </div>

            <div class="mt-4">
                <InputLabel for="recommended_by" value="Recommended By" />

                <TextInput
                    id="recommended_by"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.recommended_by"
                    placeholder="Enter the name of the user who recommended you"
                />

                <InputError class="mt-2" :message="form.errors.recommended_by" />
            </div>

            <hr class="my-6">

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
