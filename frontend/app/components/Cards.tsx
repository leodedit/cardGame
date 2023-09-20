import Card from "@/app/components/Card";
import {CardDto} from "@/app/dto/CardDto"
import style from "../style/cards.module.css"

export default function Cards({cards}: { cards: any }) {

    return (
        <ul className={style.cards}>
            {cards.map((card: CardDto) => (
                <Card key={card.id} card={card}/>
            ))}
        </ul>
    );
}