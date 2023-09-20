import styles from "../style/card.module.css";
import {CardDto} from "@/app/dto/CardDto";
import Image from "next/image";

export default function CardValue({card, large = false}: { card: CardDto, large?: boolean }) {
    let classes: any = [styles.cardValue, large ? styles.cardValueLarge : ""];

    return (
        <div className={classes.join(" ")}>
            <div className={styles.cardType}>
                <Image
                    className={styles.cardTypeImage}
                    src={`/${card.type}.svg`}
                    height={15}
                    width={15}
                    alt={card.type}
                />
            </div>
            <div className={styles.cardNumber}>
                {card.value}
            </div>
        </div>
    );
}