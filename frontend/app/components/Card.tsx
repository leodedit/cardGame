import styles from "../style/card.module.css";
import {CardDto} from "@/app/dto/CardDto";
import CardValue from "@/app/components/CardValue";
import { motion } from "framer-motion";

export default function Card({card}:{card: CardDto}) {
    return (
        <motion.div
            className={styles.card}
            initial={{ opacity: 0, y: 100 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5 }}
        >
            <div className={styles.cardTopLeft}>
                <CardValue card={card} />
            </div>
            <div className={styles.cardInner}>
                <CardValue large={true} card={card} />
            </div>
            <div className={styles.cardBottomRight}>
                <CardValue card={card} />
            </div>
        </motion.div>
    );
}