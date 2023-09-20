"use client"
import styles from "./page.module.css"
import Cards from "@/app/components/Cards";
import {useState} from "react";
import OrderTable from "@/app/components/OrderTable";
import {CardsDto} from "@/app/dto/CardsDto";
import {CardsOrdersDto} from "@/app/dto/CardsOrdersDto";

export default function Home() {
    const [data, setData] = useState<CardsOrdersDto | null>(null);
    const [dataSorted, setDataSorted] = useState<CardsDto | null>(null);

    const fetchData = async () => {
        setDataSorted(null);
        const request = await fetch("https://localhost:443/api/cards/draw");
        const response = await request.json();
        setData(response);
    };
    const sortCards = async () => {
        const requestSort = await fetch("https://localhost/api/cards/sort", {
            method: "POST",
            headers: {
                "Content-Type": "application/ld+json",
            },
            body: JSON.stringify(data),
        })
        const responseSorted = await requestSort.json()
        setDataSorted(responseSorted);
    };


    return (
        <main className={styles.main}>
            <div className={styles.buttonGroup}>
                <button className={styles.button} onClick={fetchData}>Piocher des cartes</button>
                {data ? <button className={styles.button} onClick={sortCards}>Trier les cartes</button> : ""}
            </div>
            {data ?
                <div className={styles.orderGroup}>
                    <h3 className={styles.title}>Ordre de tri des cartes</h3>
                    <OrderTable orderArray={data.orderTypes} img={true}/>
                    <OrderTable orderArray={data.orderValues}/>
                </div>
                : null}

            {data ? (
                <div className={styles.deck}>
                    <h3 className={styles.title}>Main de départ</h3>

                    {data ? <Cards cards={data.cards}/> : ""}
                </div>
            ) : ""}

            {dataSorted ? (
                <div className={styles.deck}>
                    <h3 className={styles.title}>Main triée</h3>

                    {dataSorted ? <Cards cards={dataSorted}/> : ""}
                </div>
            ) : ""}
        </main>
    )
}
