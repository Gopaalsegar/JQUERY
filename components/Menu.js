import React from 'react';
import styles from '../styles/Menu.module.css';
import Link from 'next/link';

const Menu = () => {
  return (
    <header className={`${styles.header} ${styles.sticky}`}>
      <div className={styles.menu}>
        <ul>
          <li>
            <Link href="/shop">
              <div className={styles.link1}>Sign up</div>
            </Link>
          </li>
          <li>
            <Link href="/help">
              <div className={styles.link1}>Login</div>
            </Link>
          </li>
        </ul>
      </div>
    </header>
  );
};

export default Menu;
