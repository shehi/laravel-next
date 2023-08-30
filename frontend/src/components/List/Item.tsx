import { CardsContext } from '@/contexts/CardsContext';
import { CardObject } from '@/schema/card';
import { useContext } from 'react';

interface Props {
    card: CardObject,
}
export default function Item({ card }: Props) {
    const { activeCard, setActiveCard } = useContext(CardsContext);

    return (
        <li key={card.realName}>
            <dl
                className={`grid grid-cols-1 border-2 p-2 aspect-square cursor-pointer ${activeCard?.realName === card.realName ? 'bg-red-100' : ''}`}
                onClick={() => setActiveCard && setActiveCard(card)}
            >
                <dt className="hidden">Real Name</dt>
                <dd className="truncate">{card.realName}</dd>

                <dt className="hidden">Player Name</dt>
                <dd className="truncate">{card.playerName}</dd>

                <dt className="hidden">Asset</dt>
                <dd className="truncate">{card.asset}</dd>
            </dl>
        </li>
    );
}
