#!/usr/bin/env python3
"""
Seed Script for Amazon DynamoDB
Table: student_portfolio
Partition Key: student_id (String)
Sort Key: category (String)
"""

import os
import sys
import json

def load_env():
    env_file = os.path.join(os.path.dirname(__file__), '..', '.env')
    if os.path.exists(env_file):
        with open(env_file, 'r', encoding='utf-8') as f:
            for line in f:
                line = line.strip()
                if line and not line.startswith('#') and '=' in line:
                    key, val = line.split('=', 1)
                    os.environ.setdefault(key.strip(), val.strip())

def main():
    load_env()
    region = os.environ.get('AWS_REGION', 'us-east-1')
    table_name = os.environ.get('DYNAMODB_TABLE', 'student_portfolio')
    student_id = "akhil-rajan-p"

    print(f"Connecting to DynamoDB in region: {region}...")
    try:
        import boto3
        from botocore.exceptions import ClientError
    except ImportError:
        print("[!] boto3 is not installed. To run this script:")
        print("    pip install boto3")
        print("\nAlternatively, you can use the AWS CLI command:")
        print(f"    aws dynamodb batch-write-item --request-items file://{os.path.join(os.path.dirname(__file__), 'dynamodb_items.json')}")
        sys.exit(1)

    dynamodb = boto3.resource('dynamodb', region_name=region)
    client = boto3.client('dynamodb', region_name=region)

    # Check if table exists, create if not
    try:
        table = dynamodb.Table(table_name)
        table.load()
        print(f"[✓] Table '{table_name}' already exists.")
    except ClientError as e:
        if e.response['Error']['Code'] == 'ResourceNotFoundException':
            print(f"[*] Creating DynamoDB table '{table_name}'...")
            table = dynamodb.create_table(
                TableName=table_name,
                KeySchema=[
                    {'AttributeName': 'student_id', 'KeyType': 'HASH'},  # Partition key
                    {'AttributeName': 'category', 'KeyType': 'RANGE'}    # Sort key
                ],
                AttributeDefinitions=[
                    {'AttributeName': 'student_id', 'AttributeType': 'S'},
                    {'AttributeName': 'category', 'AttributeType': 'S'}
                ],
                BillingMode='PAY_PER_REQUEST'
            )
            print("    Waiting for table to become ACTIVE...")
            table.wait_until_exists()
            print(f"[✓] Table '{table_name}' created successfully.")
        else:
            print(f"[!] Error checking table: {e}")
            sys.exit(1)

    # Items to insert
    items = [
        {
            'student_id': student_id,
            'category': 'skills',
            'name': 'Technical Skills',
            'items': [
                'Python', 'Java', 'JavaScript', 'C', 'C++',
                'FastAPI', 'OpenCV', 'HTML', 'CSS',
                'MongoDB', 'SQLite', 'SQLAlchemy',
                'Git', 'GitHub', 'Postman', 'VS Code'
            ],
            'groups': {
                'Programming Languages': ['Python', 'Java', 'JavaScript', 'C', 'C++'],
                'Frameworks & Web': ['FastAPI', 'OpenCV', 'HTML', 'CSS'],
                'Databases': ['MongoDB', 'SQLite', 'SQLAlchemy'],
                'Developer Tools': ['Git', 'GitHub', 'Postman', 'VS Code']
            },
            'description': 'Core programming languages, frameworks, databases, and development tools.'
        },
        {
            'student_id': student_id,
            'category': 'certifications',
            'name': 'Certifications',
            'items': [
                'IBM Agentic AI Internship Certificate'
            ],
            'description': 'Recognized credential validating practical engineering capability in Agentic AI workflows, prompt optimization, and AI application development.',
            'issuer': 'IBM'
        },
        {
            'student_id': student_id,
            'category': 'extracurricular',
            'name': 'Extracurricular Activities',
            'items': [
                'Member – IIAIC Club, VIT-AP University'
            ],
            'description': 'Active member of IIAIC Club at VIT-AP University participating in technical initiatives, workshops, and AI collaboration.',
            'organization': 'VIT-AP University'
        }
    ]

    print(f"[*] Inserting student portfolio items for student_id: {student_id}...")
    for item in items:
        table.put_item(Item=item)
        print(f"    [✓] Inserted category: '{item['category']}' ({item['name']})")

    print("\n[✓] DynamoDB Seeding Completed Successfully!")

if __name__ == '__main__':
    main()
