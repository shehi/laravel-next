import { CardsContext } from '@/contexts/CardsContext';
import { useContext } from 'react';

export default function Detail() {
    const { activeCard } = useContext(CardsContext);

    if (!activeCard) {
        return null;
    }

    return (
        <article
            aria-details="Details: Selected Card"
            className={`col-start-1 col-span-2 self-start border-2 p-2 ${activeCard ? '' : 'hidden'}`}
        >
            <h2 className="text-xl font-bold">Detail</h2>
            <dl className="">
                <dt className="hidden">Real Name</dt>
                <dd>{activeCard?.realName}</dd>

                <dt className="hidden">Player Name</dt>
                <dd>{activeCard?.playerName}</dd>

                <dt className="hidden">Asset</dt>
                <dd>{activeCard?.asset}</dd>
            </dl>
        </article>
    );
}
