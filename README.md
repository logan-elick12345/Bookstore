# Bookstore
Web based bookstore created for an Ecommerce class


```SQL CREATE TABLES ```

```
CREATE TABLE book (
    ISBN CHAR(10) PRIMARY KEY, 
    title VARCHAR(255) NOT NULL, 
    price FLOAT NOT NULL CHECK (price >= 0) 
);

CREATE TABLE customer (
    id SERIAL AUTO INCREMENT , 
    name VARCHAR(255) NOT NULL, 
    total_spent FLOAT DEFAULT 0 CHECK (total_spent >= 0)
);

CREATE TABLE purchases (
    isbn CHAR(10),
    custID INT,
    quantity INT NOT NULL,
    PRIMARY KEY (isbn, custID),
    FOREIGN KEY (isbn) REFERENCES book(ISBN) ON DELETE CASCADE,
    FOREIGN KEY (custID) REFERENCES customer(id) ON DELETE CASCADE
);
```
