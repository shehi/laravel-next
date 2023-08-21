import { CardsContext } from '@/contexts/CardsContext';
import { SortOrder } from '@/enums/SortOrder';
import axios from '@/lib/axios';
import { CardObject } from '@/schema/card';
import { AxiosError } from 'axios';
import { MouseEvent, useCallback, useContext } from 'react';
import { Key } from 'swr';
import useSWRMutation from 'swr/mutation';

export default function Control() {
    const { activeCard, sortOrder, setSortOrder } = useContext(CardsContext);

    const { trigger: sortCards, isMutating: isSorting } = useSWRMutation<CardObject[], AxiosError, Key, number>(
        '/api/cards',
        (_, { arg }) => axios.get(`/api/cards?sort=${arg}`).then((res) => res.data),
    );
    const { trigger: submitActiveCard, isMutating: isSubmitting } = useSWRMutation<CardObject, AxiosError, Key, CardObject>(
        '/api/cards',
        (url, { arg }) => axios.post(url, arg).then((res) => res.data),
        { revalidate: false, populateCache: false },
    );

    const sortHandler = useCallback((event: MouseEvent) => {
        if (sortOrder === undefined || setSortOrder === undefined) {
            return;
        }
        const target = event.currentTarget;
        const targetSortOrder = Number(target.getAttribute('data-sort-order')) || 0;
        if (sortOrder !== targetSortOrder) {
            setSortOrder(targetSortOrder);
            sortCards(targetSortOrder);
        }
    }, [setSortOrder, sortOrder, sortCards]);

    const submitHandler = useCallback(() => {
        activeCard && submitActiveCard(activeCard);
    }, [activeCard, submitActiveCard]);

    return (
        <form
            className="p-2 border-2 col-start-3 col-end-5 h-full"
            aria-details="Controls"
        >
            <h2 className="text-xl font-bold mb-2">Controls</h2>
            <fieldset className="grid grid-cols-4 gap-3">
                <button
                    type="button"
                    className="bg-indigo-500 disabled:opacity-70 text-white py-1 px-2"
                    data-sort-order={SortOrder.ASC}
                    onClick={sortHandler}
                    disabled={isSorting || sortOrder === SortOrder.ASC}
                    aria-disabled={isSorting || sortOrder === SortOrder.ASC}
                >Sort ASC</button>
                <button
                    type="button"
                    className="bg-indigo-500 disabled:opacity-70 text-white py-1 px-2"
                    data-sort-order={SortOrder.DESC}
                    onClick={sortHandler}
                    disabled={isSorting || sortOrder === SortOrder.DESC}
                    aria-disabled={isSorting || sortOrder === SortOrder.DESC}
                >Sort DESC</button>
                <button
                    type="button"
                    className="bg-indigo-500 disabled:opacity-70 text-white py-1 px-2 col-span-2"
                    onClick={submitHandler}
                    disabled={isSubmitting || !activeCard}
                    aria-disabled={isSubmitting || !activeCard}
                >SUBMIT</button>
            </fieldset>
        </form>
    );
}
