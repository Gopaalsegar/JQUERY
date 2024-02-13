import React from 'react';
import styles from '../styles/ImageGrid2.module.css';

const ImageGrid2 = ({ images }) => {
  return (
    <div className={styles.grid}>
      {images.map((item) => (
        <div key={item.id} className={styles.gridItem}>
          <img src={item.image} alt={item.heading} className={styles.gridImage} />
          <h2>{item.heading}</h2>
          <p dangerouslySetInnerHTML={{ __html: item.description }}></p>
        </div>
      ))}
    </div>
  );
};

export default ImageGrid2;
