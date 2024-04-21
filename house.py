import pandas as pd
from faker import Faker
import uuid
import random

fake = Faker()

# Define the number of rows you want to create
num_rows = 4000

# Create an empty list to store individual DataFrames
dfs = []

# Generate and append the fake data to the list
for i in range(1, num_rows + 1):
    building_number = fake.building_number()
    sub_city_wereda = fake.city()
    site_name = fake.word()
    house_number = fake.building_number()
    house_height = round(random.uniform(2, 5), 2)  # Assuming house height between 2 and 5 meters
    
    # Determine bedroom_number based on the specified criteria
    if i <= 308:
        bedroom_number = 0
    elif 309 <= i <= 465:  # 308 + 157 = 465
        bedroom_number = 1
    else:
        bedroom_number = 2
    
    floor_number = fake.random_int(min=1, max=10)  # Assuming 1 to 10 floors
    net_house_area = round(random.uniform(50, 200), 2)  # Assuming net house area between 50 and 200 square meters
    common_area = round(random.uniform(1, 100), 2)
    total_house_area = net_house_area + common_area
    price_per_square = round(random.uniform(1000, 3000), 2)  # Assuming price per square meter between 1000 and 3000

    # Create a DataFrame for each row
    row_df = pd.DataFrame({
        'building_number': [building_number],
        'sub_city_wereda': [sub_city_wereda],
        'site_name': [site_name],
        'house_number': [house_number],
        'house_height': [house_height],
        'bedroom_number': [bedroom_number],
        'floor_number': [floor_number],
        'net_house_area': [net_house_area],
        'common_area': [common_area],
        'total_house_area': [total_house_area],
        'price_per_square': [price_per_square]
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
