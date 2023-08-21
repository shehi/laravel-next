import { SortOrder } from '@/enums/SortOrder';
import useHasMounted from '@/hooks/useHasMounted';
import { CardObject } from '@/schema/card';
import { createContext, Dispatch, JSX, ReactNode, SetStateAction, useMemo, useState } from 'react';
import useSWR from 'swr';
import axios from '../lib/axios';

export interface CardsInterface {
    cards?: CardObject[],
    isLoading: boolean,
    sortOrder: SortOrder,
    setSortOrder: Dispatch<SetStateAction<number>>,
    activeCard?: CardObject | null,
    setActiveCard: Dispatch<SetStateAction<CardObject>>,
}

interface CardsProviderInterface {
    children: ReactNode,
}

export const CardsContext = createContext<Partial<CardsInterface>>({
    cards: undefined,
    isLoading: false,
    activeCard: undefined,
});

const useCard = (): CardsInterface => {
    const [sortOrder, setSortOrder] = useState<SortOrder>(SortOrder.NONE);
    const [activeCard, setActiveCard] = useState<CardObject | null>();
    const hasMounted = useHasMounted();

    const { data: cards, isLoading } = useSWR<CardObject[]>(
        hasMounted ? '/api/cards' : null,
        () => axios.get(`/api/cards?sort=${sortOrder}`).then((res) => res.data),
    );

    return useMemo(() => ({
        cards,
        isLoading,
        sortOrder,
        setSortOrder,
        activeCard,
        setActiveCard,
    }), [activeCard, cards, isLoading, sortOrder]);
};

export function CardsProvider({ children }: CardsProviderInterface): JSX.Element {
    return <CardsContext.Provider value={useCard()}>{children}</CardsContext.Provider>;
}
