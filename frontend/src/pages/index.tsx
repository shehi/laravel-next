import Control from '@/components/Control';
import Detail from '@/components/Detail';
import List from '@/components/List';
import Loading from '@/components/Loading';
import { CardsProvider } from '@/contexts/CardsContext';
import Head from 'next/head';
import { Suspense } from 'react';

export default function Home() {
    return (
        <>
            <Head>
                <title>Omnevo Task</title>
            </Head>

            <main className="relative grid grid-cols-[150px_150px_150px_200px] grid-rows-[120px_minmax(500px,_1fr)] gap-4 sm:items-center p-8">
                <CardsProvider>
                    <Detail />
                    <Control />
                    <Suspense fallback={<Loading className="col-span-4 row-span-2 w-full" />}>
                        <List />
                    </Suspense>
                </CardsProvider>
            </main>
        </>
    );
}
