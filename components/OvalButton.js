
import React from 'react';
import styles from '../styles/OvalButton.module.css';

const OvalButton = ({ text }) => {
  return (
    <button className={styles.button}>{text}</button>
  );
};

export default OvalButton;
