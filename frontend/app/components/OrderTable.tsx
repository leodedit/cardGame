import React from "react";
import Image from "next/image";
import styles from "@/app/style/orderTable.module.css";

export default function OrderTable({orderArray, img = false}: { orderArray: any, img?: boolean }) {
    return (
        <div className={styles.orderTableContainer}>
            <table className={styles.orderTable}>
                <tbody>
                    <tr className={styles.orderTableTr}>
                        {orderArray.map((orderItem: any) => (
                            <td key={orderItem} className={styles.orderTableTd}>
                                {img ?
                                <Image className={styles.cardTypeImage} src={`/${orderItem}.svg`} height={15} width={15}
                                       alt={orderItem}/>
                                : orderItem}
                            </td>
                        ))}
                    </tr>
                </tbody>
            </table>
        </div>
    );
}