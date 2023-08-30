import Item from '@/components/List/Item';
import Loading from '@/components/Loading';
import { CardsContext } from '@/contexts/CardsContext';
import { useContext } from 'react';

export default function List() {
    const { cards, isLoading } = useContext(CardsContext);

    const cardsRendered = cards?.map((card) => <Item key={card.realName} card={card} />);

    if (!cards || isLoading) {
        return <Loading className="col-span-4 row-span-2 w-full" />;
    }

    return (
        <section className="col-span-4 row-span-2" aria-details="Overview: List of Cards">
            <h2 className="text-xl font-bold">Overview</h2>
            <ul className="grid grid-cols-3 gap-6">{cardsRendered}</ul>
        </section>
    );
}
