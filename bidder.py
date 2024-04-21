import pandas as pd
from faker import Faker
import uuid

fake = Faker()

# Define the number of rows you want to create
num_rows = 40000

# Create an empty list to store individual DataFrames
dfs = []

# Generate and append the fake data to the list
for i in range(1, num_rows + 1):
    first_name = fake.first_name()
    last_name = fake.last_name()
    full_name = f"{first_name} {last_name}"
    gender = fake.random_element(elements=('Male', 'Female'))
    phone = fake.phone_number()
    receipt_number = fake.uuid4().hex[:10]  # Generate a random receipt number

    # Create a DataFrame for each row
    row_df = pd.DataFrame({
        'full_name': [full_name],
        'gender': [gender],
        'phone': [phone],
        'receipt_number': [receipt_number]
    })

    # Append the individual DataFrame to the list
    dfs.append(row_df)

# Concatenate all DataFrames in the list
df = pd.concat(dfs, ignore_index=True)

# Generate a random filename using uuid
random_filename = f'fake_data_{uuid.uuid4().hex}.xlsx'

# Convert the DataFrame to an Excel file with the random filename
df.to_excel(random_filename, index=False, engine='openpyxl')

print(f"Data saved to {random_filename}")
