import React from 'react';
import styles from '../styles/ImageGrid.module.css';
import Link from 'next/link';

const ImageGrid = () => {
  const gridItems = [
    {
      id: 1,
      image: '/images/Carhartt.png',
     
    },
    {
      id: 2,
      image: '/images/google.png',
    
    },
    {
      id: 3,
      image: '/images/Merrel.png',
    
    },
    {
      id: 4,
      image: '/images/PUMA.png',
     
    },
  ];

  return (
    <div className={styles.heading}>
     
    <div className={styles.content}>
    <h1>Who we work with.</h1>

    <div className={styles.gridContainer}>
      {gridItems.map((item) => (
        <div key={item.id} className={styles.gridItem}>
          <img src={item.image} alt={item.heading} className={styles.gridImage} />
     
        </div>
      ))}
      </div>
    </div>
    <div> 
    <Link href="/shop">
              <div className={styles.link}>View out partners</div>
            </Link>
    </div>
    </div>
  );
};

export default ImageGrid;
