import axios, { AxiosResponse } from 'axios';
import { computed, reactive, ref } from 'vue';

export const useFetch = <T = any>(url: string, config: any = {}) => {
    const data = ref<T | null>(null);
    const response = ref<AxiosResponse<T> | null>(null);
    const error = ref<unknown>(null);
    const loading = ref(false);

    const fetchData = async () => {
        loading.value = true;
        try {
            const result = await axios.request<T>({
                url,
                ...config,
            });

            response.value = result;
            data.value = result.data;
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    if (!config.skip) {
        fetchData();
    }

    return { data, error, loading, response, fetchData };
};

const cache = reactive(new Map());

export const useFetchCache = (key: string, url: string, config = {}) => {
    const info = useFetch(url, { skip: true, ...config });

    const update = () => cache.set(key, info.data);
    const clear = () => cache.delete(key);

    const fetch = async () => {
        try {
            await info.fetchData();
            update();
        } catch {
            clear();
        }
    };

    const response = computed(() => cache.get(key));
    const data = computed(() => response.value);

    // Se já existe no cache, usa direto, senão busca
    if (!response.value) {
        fetch();
    }

    return { ...info, fetch, response, data, clear };
};
